<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\VoteOption;

class ResultController extends Controller
{
    public function show(Election $election)
    {
        $election->load([
            'categories',
            'sections.options',
            'participations.category',
            'participations.vote.options',
        ]);

        $totalVotes = $election->participations()->count();

        $results = [];

        foreach ($election->sections as $section) {
            $sectionResults = [];

            foreach ($section->options as $option) {
                $votesCount = $option->votes()
                    ->whereHas('participation', function ($query) use ($election) {
                        $query->where('election_id', $election->id);
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

        $participationByCategory = $election->participations
            ->groupBy('category.name')
            ->map(function ($items) {
                return $items->count();
            });

        return view('admin.results.show', compact(
            'election',
            'totalVotes',
            'results',
            'participationByCategory'
        ));
    }
}