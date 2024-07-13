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

        return view('dashboard.index', compact('scores','mobilityPercentage', 'confusePercentage', 'feedPercentage', 'toiletPercentage'));
    }

}
