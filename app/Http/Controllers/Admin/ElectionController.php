<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::with('creator')
            ->latest()
            ->get();

        return view('admin.elections.index', compact('elections'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.elections.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'status' => ['required', 'in:draft,active,closed,archived'],
            'is_anonymous' => ['required', 'boolean'],
            'show_realtime_results' => ['required', 'boolean'],
            'voting_type' => ['required', 'in:single,multiple,category_single,category_multiple'],
            'max_selections' => ['required', 'integer', 'min:1'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['exists:categories,id'],
        ]);

        $election = Election::create([
            'created_by' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'start_at' => $validated['start_at'] ?? null,
            'end_at' => $validated['end_at'] ?? null,
            'status' => $validated['status'],
            'is_anonymous' => $validated['is_anonymous'],
            'show_realtime_results' => $validated['show_realtime_results'],
            'voting_type' => $validated['voting_type'],
            'max_selections' => $validated['max_selections'],
        ]);

        $election->categories()->sync($validated['categories']);

        return redirect()
            ->route('admin.elections.index')
            ->with('success', 'La votación se ha creado correctamente.');
    }
    public function show(Election $election)
{
    $election->load([
        'creator',
        'categories',
        'sections.options',
    ]);

    return view('admin.elections.show', compact('election'));
}
}