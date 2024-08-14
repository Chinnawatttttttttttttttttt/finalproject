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
            'Group 1' => 0, // ปกติ
            'Group 2' => 0, // ติดบ้าน
            'Group 3' => 0, // ติดเตียง
        ];

        foreach ($scores as $score) {
            $group = $this->determineGroup($score);

            // ตรวจสอบว่ากลุ่มที่คืนค่ามีอยู่ใน $groupCounts หรือไม่
            if (array_key_exists($group, $groupCounts)) {
                $groupCounts[$group]++;
            }
        }

        return $groupCounts;
    }

    private function determineGroup($score)
    {
        $mobility = $score->mobility;

        if (in_array($mobility, [5, 4])) {
            return 'Group 1'; // ปกติ
        } elseif (in_array($mobility, [3]) || in_array($score->confuse, [4, 3, 2])) {
            return 'Group 2'; // ติดบ้าน
        } elseif (in_array($mobility, [1, 2])) {
            return 'Group 3'; // ติดเตียง
        }

        return 'Unknown'; // ถ้าไม่อยู่ในกลุ่มใด
    }
}
