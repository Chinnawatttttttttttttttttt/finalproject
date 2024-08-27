<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\NewsVisitor;
use Illuminate\Http\Request;
use App\Models\VisitsAndLogins;
use App\Models\NewsVisitorews;

class HomeController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลจำนวนการเข้าชมทั้งหมด
        $totalVisits = VisitsAndLogins::count();

        // ดึงข้อมูลจำนวนการล็อกอินทั้งหมด
        $totalLogins = VisitsAndLogins::where('is_login', true)->count();

        // ดึงข่าวสารล่าสุด 5 รายการ
        $latestNews = NewsVisitor::latest()->take(5)->get();

        // ส่งข้อมูลไปยัง View
        return view('welcome', compact('totalVisits', 'totalLogins', 'latestNews'));
    }
}
