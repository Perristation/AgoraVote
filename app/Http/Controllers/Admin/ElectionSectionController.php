<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionSection;
use App\Models\VoteOption;
use Illuminate\Http\Request;

class ElectionSectionController extends Controller
{
    public function create(Election $election)
    {
        return view('admin.elections.sections.create', compact('election'));
    }

    public function store(Request $request, Election $election)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_selections' => ['required', 'integer', 'min:1'],
            'options' => ['required', 'array'],
            'options.*' => ['nullable', 'string', 'max:255'],
        ]);

        $options = collect($validated['options'])
            ->map(function ($option) {
                return trim((string) $option);
            })
            ->filter(function ($option) {
                return $option !== '';
            })
            ->values();

        if ($options->count() < 2) {
            return back()
                ->withInput()
                ->withErrors([
                    'options' => 'Debes introducir al menos dos opciones de voto.',
                ]);
        }

        $section = ElectionSection::create([
            'election_id' => $election->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'max_selections' => $validated['max_selections'],
        ]);

        foreach ($options as $index => $optionText) {
            VoteOption::create([
                'election_section_id' => $section->id,
                'text' => $optionText,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        return redirect()
            ->route('admin.elections.show', $election)
            ->with('success', 'La sección y sus opciones se han creado correctamente.');
    }
}