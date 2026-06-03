<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResultController extends Controller
{
    public function show(Election $election)
    {
        $election->load([
            'categories',
            'sections.options.votes.participation',
            'participations.category',
        ]);

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

        $participationByCategory = $election->participations
            ->groupBy(function ($participation) {
                return $participation->category->name ?? 'Sin categoría';
            })
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

    public function export(Election $election): StreamedResponse
    {
        if ($election->status !== 'closed') {
            abort(403, 'Solo se pueden exportar resultados de votaciones cerradas.');
        }

        $election->load([
            'categories',
            'sections.options.votes.participation',
            'participations.category',
        ]);

        $totalVotes = $election->participations()->count();

        $fileName = 'resultados_' . str_replace(' ', '_', strtolower($election->title)) . '.csv';

        return response()->streamDownload(function () use ($election, $totalVotes) {
            $handle = fopen('php://output', 'w');

            // BOM para que Excel abra bien los acentos en Windows
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, ['AgoraVote - Exportación de resultados']);
            fputcsv($handle, ['Votación', $election->title]);
            fputcsv($handle, ['Descripción', $election->description ?? 'Sin descripción']);
            fputcsv($handle, ['Estado', $election->status]);
            fputcsv($handle, ['Total de votos', $totalVotes]);
            fputcsv($handle, []);

            fputcsv($handle, ['Participación por categoría']);
            fputcsv($handle, ['Categoría', 'Votos']);

            $participationByCategory = $election->participations
                ->groupBy(function ($participation) {
                    return $participation->category->name ?? 'Sin categoría';
                })
                ->map(function ($items) {
                    return $items->count();
                });

            foreach ($participationByCategory as $categoryName => $count) {
                fputcsv($handle, [$categoryName, $count]);
            }

            fputcsv($handle, []);
            fputcsv($handle, ['Resultados por opción']);
            fputcsv($handle, ['Sección', 'Opción', 'Votos', 'Porcentaje']);

            foreach ($election->sections as $section) {
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

                    fputcsv($handle, [
                        $section->title,
                        $option->text,
                        $votesCount,
                        $percentage . '%',
                    ]);
                }
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}