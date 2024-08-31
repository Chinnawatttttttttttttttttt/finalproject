<?php

namespace App\Http\Controllers;
use App\Models\VisitsAndLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{

    // ฟังก์ชันสำหรับแสดงข้อมูลการเข้าชมทั้งหมด
    public function index()
    {
        $visits = VisitsAndLogins::with('user')->orderBy('visited_at', 'desc')->get();
        return view('visits.index', compact('visits'));
    }

    // ฟังก์ชันสำหรับแสดงข้อมูลการเข้าชมเฉพาะของผู้ใช้ที่เข้าสู่ระบบ
    public function logins()
    {
        $logins = VisitsAndLogins::with('user')->where('is_login', true)->orderBy('visited_at', 'desc')->get();
        return view('visits.logins', compact('logins'));
    }
    
}
