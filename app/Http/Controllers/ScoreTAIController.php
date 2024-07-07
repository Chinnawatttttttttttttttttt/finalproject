<?php

namespace App\Http\Controllers;
use App\Models\ScoreTAI;
use App\Models\Group;
use App\Models\Elderly;
use App\Models\user;

use Illuminate\Http\Request;

class ScoreTAIController extends Controller
{
    public function evaluate(Request $request)
    {
        $request->validate([
            'elderly_id' => 'required|integer',
            'mobility' => 'required|integer|min:0|max:5',
            'confuse' => 'required|integer|min:0|max:5',
            'feed' => 'required|integer|min:0|max:5',
            'toilet' => 'required|integer|min:0|max:5',
            'user_id' => 'required|integer',
        ]);

        $scoreTAI = ScoreTAI::where('elderly_id', $request->elderly_id)->first();

        if ($scoreTAI) {
            $scoreTAI->update([
                'mobility' => $request->mobility,
                'confuse' => $request->confuse,
                'feed' => $request->feed,
                'toilet' => $request->toilet,
                'user_id' => $request->user_id,
            ]);

            return response()->json(['message' => 'Score updated successfully']);
        } else {
            return response()->json(['message' => 'ScoreTAI not found'], 404);
        }
    }
}
