<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\Position;
use App\Models\Department;
use App\Models\ScoreTAI;
use App\Models\Elderly;
use App\Models\Group;

class DashboardController extends Controller
{
    public function index()
    {
        $scores = ScoreTAI::all();
        $mobilityPercentage = $scores->avg('mobility');
        $confusePercentage = $scores->avg('confuse');
        $feedPercentage = $scores->avg('feed');
        $toiletPercentage = $scores->avg('toilet');

        $groupCounts = $this->calculateGroupCounts($scores);

        return view('dashboard.index', compact('scores', 'mobilityPercentage', 'confusePercentage', 'feedPercentage', 'toiletPercentage', 'groupCounts'));
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
