<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScoreTAI;
use App\Models\Group; // Import Group model
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve scores from ScoreTAI
        $scores = ScoreTAI::all();

        // Calculate group counts from scores
        $groupCounts = $this->calculateGroupCounts($scores);

        // Retrieve group data from Group model
        $groupData = Group::select('name', DB::raw('count(*) as count'))
            ->groupBy('name')
            ->pluck('count', 'name');

        // Prepare score counts based on group data
        $scoreCounts = [
            'B5' => $groupData['B5'] ?? 0,
            'B4' => $groupData['B4'] ?? 0,
            'B3' => $groupData['B3'] ?? 0,
            'C4' => $groupData['C4'] ?? 0,
            'C3' => $groupData['C3'] ?? 0,
            'C2' => $groupData['C2'] ?? 0,
            'I3' => $groupData['I3'] ?? 0,
            'I2' => $groupData['I2'] ?? 0,
            'I1' => $groupData['I1'] ?? 0,
        ];

        // Get colors for each group from config
        $groupColors = config('group_colors');
        $lastUpdate = Carbon::now()->toDateTimeString();

        // Send data to the View
        return view('dashboard.index', compact(
            'lastUpdate',
            'groupCounts',
            'groupColors',
            'scoreCounts' // Include the score counts in the view data
        ));
    }

    private function calculateGroupCounts($scores)
{
    $groupCounts = [
        // 'ยังไม่ได้ประเมิน' => 0,
        'Group 0' => 0,
        'Group 1' => 0,
        'Group 2' => 0,
        'Group 3' => 0,
    ];

    foreach ($scores as $score) {
        \Log::info('Processing score:', [
            'mobility' => $score->mobility,
            'confuse' => $score->confuse,
            'feed' => $score->feed,
            'toilet' => $score->toilet,
        ]);

        $group = $this->determineGroup($score);

        // \Log::info('Determined group:', ['group' => $group]);

        if (array_key_exists($group, $groupCounts)) {
            $groupCounts[$group]++;
        }
    }

    // \Log::info('Final group counts:', $groupCounts);

    return $groupCounts;
}



private function determineGroup($score)
{
    // ใช้ค่า default เป็น 0 หากค่าคะแนนเป็น null
    $mobility = $score->mobility ?? null;
    $confuse = $score->confuse ?? null;
    $feed = $score->feed ?? null;
    $toilet = $score->toilet ?? null;

    // ตรวจสอบค่าทั้งหมดเป็น null
    if (is_null($mobility) && is_null($confuse) && is_null($feed) && is_null($toilet)) {
        return 'Group 0'; // หรือข้อความที่คุณต้องการให้แสดง
    }

    // ตรวจสอบกลุ่มที่ถูกต้องตามข้อมูลที่ให้มา
    if ($mobility == 5 && $confuse == 5 && $feed == 5 && $toilet == 5) {
        return 'Group 1';
    } elseif ($mobility >= 3 && $confuse >= 4 && $feed >= 4 && $toilet >= 4) {
        return 'Group 1';
    } elseif ($mobility >= 3 && $confuse >= 4 && $feed <= 3 && $toilet <= 3) {
        return 'Group 2';
    } elseif ($mobility >= 3 && $confuse <= 3 && $feed >= 4 && $toilet >= 4) {
        return 'Group 2';
    } elseif ($mobility >= 3 && $confuse <= 3 && $feed == 3 && $toilet == 4) {
        return 'Group 2';
    } elseif ($mobility >= 3 && $confuse <= 3 && $feed == 4 && $toilet == 3) {
        return 'Group 2';
    } elseif ($mobility >= 3 && $confuse <= 3 && $feed <= 3 && $toilet <= 3) {
        return 'Group 2';
    } elseif ($mobility <= 2 && $feed >= 4) {
        return 'Group 3';
    } elseif ($mobility <= 2 && $feed == 3) {
        return 'Group 3';
    } elseif ($mobility <= 2 && $feed <= 2) {
        return 'Group 3';
    } else {
        return 'Error Group'; // ถ้าไม่อยู่ในกลุ่มใด
    }
}

}
