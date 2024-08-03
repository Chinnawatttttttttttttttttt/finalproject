<?php

namespace App\Http\Controllers;

use App\Exports\ScoreExports;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportScores()
    {
        return Excel::download(new ScoreExports, 'scores.xlsx');
    }
}
