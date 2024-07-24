<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use App\Models\ScoreTAI;
use App\Models\Elderly;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function printPDF()
    {
        $user = Auth::user(); // หรือดึงข้อมูลผู้ใช้งานตามที่ต้องการ
        $scores = ScoreTAI::with('elderly')->get(); // ดึงข้อมูลคะแนนและผู้สูงอายุ
        $elderly = Elderly::find($scores->first()->elderly_id);
        // $pdf = PDF::loadView('pdf.report-score', compact('user', 'scores'));
        return view('pdf.report-score',compact('user','scores'));
    }
}
