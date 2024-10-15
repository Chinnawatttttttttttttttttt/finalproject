<?php

namespace App\Http\Controllers;

use App\Models\ScoreTAI;
use App\Models\Elderly;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ScoreTAIController extends Controller
{
    public function create($id)
    {
        $score = ScoreTAI::find($id);

        if (!$score) {
            return redirect()->back()->with('error', 'ไม่พบคะแนน');
        }

        $elderly = Elderly::find($score->elderly_id);

        if (!$elderly) {
            return redirect()->back()->with('error', 'ไม่พบผู้สูงอายุ');
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
            return redirect()->back()->with('error', 'ไม่พบคะแนน');
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

        // Check if the group exists and delete if so
        $existingGroup = Group::where('elderly_id', $request->input('elderly_id'))->first();
        if ($existingGroup) {
            $existingGroup->delete();
        }

        // Save group information
        $group = new Group();
        $group->name = $group_name;
        $group->elderly_id = $request->input('elderly_id');
        $group->save();

        // Redirect to index page with success message
        return redirect()->route('service.details', ['score_id' => $score->id])
            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function showTAI()
    {
        $scores = ScoreTAI::all();
        $groups = Group::all();

        if ($scores->isEmpty()) {
            return redirect()->back()->with('error', 'ไม่พบคะแนน');
        }

        // Assuming the first score's elderly and user details are needed for display
        $elderly = Elderly::find($scores->first()->elderly_id);

        if (!$elderly) {
            return redirect()->back()->with('error', 'ไม่พบผู้สูงอายุ');
        }

        $user = Auth::user(); // Get the authenticated user
        // Split address
        $address = $elderly->Address;
        $addressParts = preg_split('/\s+/', $address); // Split by whitespace

        // Assuming the address structure is defined:
        $houseNumber = $addressParts[1] ?? '';
        $village = $addressParts[3] ?? '';
        $subdistrict = $addressParts[5] ?? '';
        $district = $addressParts[7] ?? '';
        $province = $addressParts[9] ?? '';
        $postalCode = $addressParts[11] ?? '';

        // Calculate age
        $age = (new \Carbon\Carbon($elderly->Birthday))->diffInYears();

        return view('TAI.index', compact('scores', 'elderly', 'user', 'groups', 'houseNumber', 'village', 'subdistrict', 'district', 'province', 'postalCode', 'age'));
    }

    public function show()
    {
        $scores = ScoreTAI::all();
        $groups = Group::all();

        if ($scores->isEmpty()) {
            return redirect()->back()->with('error', 'ไม่พบคะแนน');
        }

        $elderly = Elderly::find($scores->first()->elderly_id);

        if (!$elderly) {
            return redirect()->back()->with('error', 'ไม่พบผู้สูงอายุ');
        }

        $user = Auth::user(); // Get the authenticated user
        // Split address
        $address = $elderly->Address;
        $addressParts = preg_split('/\s+/', $address); // Split by whitespace

        // Assuming the address structure is defined:
        $houseNumber = $addressParts[1] ?? '';
        $village = $addressParts[3] ?? '';
        $subdistrict = $addressParts[5] ?? '';
        $district = $addressParts[7] ?? '';
        $province = $addressParts[9] ?? '';
        $postalCode = $addressParts[11] ?? '';

        // Calculate age
        $age = (new \Carbon\Carbon($elderly->Birthday))->diffInYears();

        return view('TAI.show', compact('scores', 'elderly', 'user', 'groups', 'houseNumber', 'village', 'subdistrict', 'district', 'province', 'postalCode', 'age'));
    }

    public function service()
    {
        $scores = ScoreTAI::with('group', 'elderly')->get(); // ใช้ eager loading เพื่อดึงข้อมูลที่เกี่ยวข้อง
        $groups = Group::all();

        if ($scores->isEmpty()) {
            return redirect()->back()->with('error', 'ไม่พบคะแนน');
        }

        // ตรวจสอบว่าผู้สูงอายุมีข้อมูลหลายคนหรือไม่
        $elderlyIds = $scores->pluck('elderly_id')->unique();
        $elderlies = Elderly::whereIn('id', $elderlyIds)->get();

        if ($elderlies->isEmpty()) {
            return redirect()->back()->with('error', 'ไม่พบผู้สูงอายุ');
        }

        $user = Auth::user();

        // ส่งข้อมูลไปยังมุมมอง
        return view('TAI.service', [
            'scores' => $scores,
            'elderlies' => $elderlies,
            'user' => $user,
            'groups' => $groups,
        ]);
    }

    public function details($score_id)
    {
        $score = ScoreTAI::find($score_id);
        if (!$score) {
            return redirect()->back()->with('error', 'ไม่พบคะแนน');
        }

        $group = Group::find($score->group_id);
        $elderly = Elderly::find($score->elderly_id);

        return view('TAI.details', compact('score', 'group', 'elderly'));
    }

    private function determineGroup($score)
    {
        $mobility = $score->mobility;
        $confuse = $score->confuse;
        $feed = $score->feed;
        $toilet = $score->toilet;

        if ($mobility == 5 && $confuse == 5 && $feed == 5 && $toilet == 5) {
            return 'B5';
        } elseif ($mobility >= 3 && $confuse >= 4 && $feed >= 4 && $toilet >= 4) {
            return 'B4';
        } elseif ($mobility >= 3 && $confuse >= 4 && $feed <= 3 && $toilet <= 3) {
            return 'B3';
        } elseif ($mobility >= 3 && $confuse <= 3 && $feed >= 4 && $toilet >= 4) {
            return 'C4';
        } elseif ($mobility >= 3 && $confuse <= 3 && $feed == 3 && $toilet == 4) {
            return 'C3';
        } elseif ($mobility >= 3 && $confuse <= 3 && $feed == 4 && $toilet == 3) {
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
            return 'ไม่พบคะแนน';
        }
    }
}
