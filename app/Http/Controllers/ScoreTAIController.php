<?php

namespace App\Http\Controllers;

use App\Models\ScoreTAI;
use App\Models\Elderly;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ScoreTAIController extends Controller
{
    public function create($id)
    {
        $score = ScoreTAI::find($id);

        if (!$score) {
            return redirect()->back()->with('error', 'Score not found');
        }

        $elderly = Elderly::find($score->elderly_id);

        if (!$elderly) {
            return redirect()->back()->with('error', 'Elderly not found');
        }

        $user = Auth::user(); // Get the authenticated user

        return view('TAI.score', compact('id', 'elderly', 'score', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'elderly_id' => 'required|integer',
            'user_id' => 'required|integer',
            'mobility' => 'required|integer|min:0|max:5',
            'confuse' => 'required|integer|min:0|max:5',
            'feed' => 'required|integer|min:0|max:5',
            'toilet' => 'required|integer|min:0|max:5',
        ]);

        // Find or create ScoreTAI record
        $score = ScoreTAI::find($request->input('id'));
        if (!$score) {
            return redirect()->back()->with('error', 'Score not found');
        }

        // Update ScoreTAI record
        $score->elderly_id = $request->input('elderly_id');
        $score->user_id = $request->input('user_id');
        $score->mobility = $request->input('mobility');
        $score->confuse = $request->input('confuse');
        $score->feed = $request->input('feed');
        $score->toilet = $request->input('toilet');
        $score->save();

        // Determine group
        $group_name = $this->determineGroup($score);

        // Save group information
        $group = new Group();
        $group->name = $group_name;
        $group->elderly_id = $request->input('elderly_id');
        $group->save();

        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว')->with('group', $group_name);
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
