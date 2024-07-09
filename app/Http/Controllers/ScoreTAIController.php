<?php

namespace App\Http\Controllers;
use App\Models\ScoreTAI;
use App\Models\Group;
use App\Models\Elderly;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ScoreTAIController extends Controller
{
    public function create($id)
    {
        $score = ScoreTAI::find($id);
        $elderly = Elderly::find($score->elderly_id); // หาข้อมูลผู้สูงอายุจาก score_tais โดยใช้ elderly_id

        return view('TAI.score', compact('id', 'elderly', 'score'));
    }
}
