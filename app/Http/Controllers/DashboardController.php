<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScoreTAI;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $scores = ScoreTAI::all();
        $mobilityPercentage = $scores->avg('mobility');
        $confusePercentage = $scores->avg('confuse');
        $feedPercentage = $scores->avg('feed');
        $toiletPercentage = $scores->avg('toilet');

        // Calculate group averages and counts
        $groupAverages = $this->calculateGroupAverages($scores);
        $groupCounts = $this->calculateGroupCounts($scores);

        // Define colors for each group
        $groupColors = [
            'B5' => '#ff0000',   // Red
            'B4' => '#ff6600',   // Orange
            'B3' => '#ffff00',   // Yellow
            'C4' => '#00ff00',   // Green
            'C3' => '#0000ff',   // Blue
            'C2' => '#6600ff',   // Purple
            'I3' => '#ff00ff',   // Magenta
            'I2' => '#00ffff',   // Cyan
            'I1' => '#f5f5f5',   // Light Gray
            'Unknown' => '#cccccc'  // Gray
        ];

        $lastUpdate = Carbon::now()->toDateTimeString();

        // Pass data to view
        return view('dashboard.index', compact('lastUpdate','mobilityPercentage', 'confusePercentage', 'feedPercentage', 'toiletPercentage', 'groupAverages', 'groupCounts', 'groupColors'));
    }

    private function calculateGroupAverages($scores)
    {
        $groupCounts = [
            'B5' => 0,
            'B4' => 0,
            'B3' => 0,
            'C4' => 0,
            'C3' => 0,
            'C2' => 0,
            'I3' => 0,
            'I2' => 0,
            'I1' => 0,
            'Unknown' => 0,
        ];

        foreach ($scores as $score) {
            $group = $this->determineGroup($score);
            $groupCounts[$group]++;
        }

        $groupAverages = [];
        $totalScores = count($scores);

        foreach ($groupCounts as $group => $count) {
            if ($totalScores > 0) {
                $average = round(($count / $totalScores) * 100, 2);
            } else {
                $average = 0;
            }
            $groupAverages[$group] = $average;
        }

        return $groupAverages;
    }

    private function calculateGroupCounts($scores)
    {
        $groupCounts = [
            'B5' => 0,
            'B4' => 0,
            'B3' => 0,
            'C4' => 0,
            'C3' => 0,
            'C2' => 0,
            'I3' => 0,
            'I2' => 0,
            'I1' => 0,
            'Unknown' => 0,
        ];

        foreach ($scores as $score) {
            $group = $this->determineGroup($score);
            $groupCounts[$group]++;
        }

        return $groupCounts;
    }

    private function determineGroup($score)
    {
        $mobility = $score->mobility;
        $confuse = $score->confuse;
        $feed = $score->feed;
        $toilet = $score->toilet;

        if ($mobility == 5 && $confuse == 5 && $feed == 5 && $toilet == 5) {
            return 'B5';
        } elseif ($mobility >= 4 && $confuse >= 4 && $feed >= 4 && $toilet >= 4) {
            return 'B4';
        } elseif ($mobility >= 3 && $confuse >= 4 && $feed <= 3 && $toilet <= 3) {
            return 'B3';
        } elseif ($mobility >= 3 && $confuse <= 3 && $feed >= 4 && $toilet >= 4) {
            return 'C4';
        } elseif ($mobility >= 3 && $confuse <= 3 && $feed == 3 && $toilet == 4) {
            return 'C3';
        } elseif ($mobility >= 3 && $confuse <= 3 && $feed <= 3 && $toilet <= 3) {
            return 'C2';
        } elseif ($mobility <= 2 && $feed >= 4) {
            return 'I3';
        } elseif ($mobility <= 2 && $feed == 3) {
            return 'I2';
        } elseif ($mobility <= 2 && $feed <= 2) {
            return 'I1';
        } else {
            return 'Unknown';
        }
    }
}
