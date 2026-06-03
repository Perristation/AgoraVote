<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Election;
use App\Models\Participation;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoteController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $userCategoryIds = $user->categories()->pluck('categories.id');

        $elections = Election::with(['categories', 'sections.options'])
            ->where('status', 'active')
            ->whereHas('categories', function ($query) use ($userCategoryIds) {
                $query->whereIn('categories.id', $userCategoryIds);
            })
            ->latest()
            ->get();

        return view('votes.index', compact('elections'));
    }

    public function show(Election $election)
    {
        $user = auth()->user();

        $election->load(['categories', 'sections.options']);

        $userCategories = $user->categories()
            ->whereIn('categories.id', $election->categories->pluck('id'))
            ->get();

        if ($userCategories->isEmpty()) {
            abort(403, 'No tienes permiso para participar en esta votación.');
        }

        return view('votes.show', compact('election', 'userCategories'));
    }

    public function store(Request $request, Election $election)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'options' => ['required', 'array', 'min:1'],
            'options.*' => ['exists:vote_options,id'],
        ]);

        $category = Category::findOrFail($validated['category_id']);

        $userHasCategory = $user->categories()
            ->where('categories.id', $category->id)
            ->exists();

        if (! $userHasCategory) {
            abort(403, 'No perteneces a esta categoría.');
        }

        $electionAllowsCategory = $election->categories()
            ->where('categories.id', $category->id)
            ->exists();

        if (! $electionAllowsCategory) {
            abort(403, 'Esta categoría no está autorizada en esta votación.');
        }

        $alreadyVoted = Participation::where('user_id', $user->id)
            ->where('election_id', $election->id)
            ->where('category_id', $category->id)
            ->exists();

        if ($alreadyVoted) {
            return redirect()
                ->route('votes.show', $election)
                ->with('error', 'Ya has votado en esta votación con la categoría seleccionada.');
        }

        $validOptionIds = $election->sections()
            ->with('options')
            ->get()
            ->flatMap(function ($section) {
                return $section->options->pluck('id');
            })
            ->toArray();

        foreach ($validated['options'] as $optionId) {
            if (! in_array((int) $optionId, $validOptionIds, true)) {
                abort(422, 'Una de las opciones seleccionadas no pertenece a esta votación.');
            }
        }

        if (count($validated['options']) > $election->max_selections) {
            return back()
                ->withInput()
                ->with('error', 'Has seleccionado más opciones de las permitidas.');
        }

        $verificationCode = strtoupper(Str::random(12));

        $participation = Participation::create([
            'user_id' => $user->id,
            'election_id' => $election->id,
            'category_id' => $category->id,
            'voted_at' => now(),
            'verification_code' => $verificationCode,
        ]);

        $vote = Vote::create([
            'participation_id' => $participation->id,
            'registered_at' => now(),
            'encrypted_value' => null,
        ]);

        $vote->options()->sync($validated['options']);

        return redirect()
            ->route('votes.confirmation', $participation)
            ->with('success', 'Tu voto se ha registrado correctamente.');
    }

    public function confirmation(Participation $participation)
    {
        if ($participation->user_id !== auth()->id()) {
            abort(403);
        }

        $participation->load(['election', 'category']);

        return view('votes.confirmation', compact('participation'));
    }

    public function results(Election $election)
    {
        $user = auth()->user();

        if (! $election->show_realtime_results) {
            abort(403, 'Los resultados en vivo no están habilitados para esta votación.');
        }

        $election->load([
            'categories',
            'sections.options.votes.participation',
            'participations.category',
        ]);

        $userCategories = $user->categories()
            ->whereIn('categories.id', $election->categories->pluck('id'))
            ->get();

        if ($userCategories->isEmpty()) {
            abort(403, 'No tienes permiso para consultar los resultados de esta votación.');
        }

        $totalVotes = $election->participations()->count();

        $results = [];

        foreach ($election->sections as $section) {
            $sectionResults = [];

            foreach ($section->options as $option) {
                $votesCount = $option->votes
                    ->filter(function ($vote) use ($election) {
                        return $vote->participation
                            && $vote->participation->election_id === $election->id;
                    })
                    ->count();

                $percentage = $totalVotes > 0
                    ? round(($votesCount / $totalVotes) * 100, 2)
                    : 0;

                $sectionResults[] = [
                    'option' => $option,
                    'votes' => $votesCount,
                    'percentage' => $percentage,
                ];
            }

            $results[] = [
                'section' => $section,
                'options' => $sectionResults,
            ];
        }

        return view('votes.results', compact('election', 'totalVotes', 'results'));
    }
}