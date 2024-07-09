<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route สำหรับจำนวนผู้สูงอายุในจังหวัดบุรีรัมย์
Route::get('/api/elderly/count/buriram', function () {
    $count = App\Models\Elderly::where('Province', 'Buriram')->count();
    return response()->json(['count' => $count]);
});

// Route สำหรับจำนวนอำเภอที่มีข้อมูลผู้สูงอายุในแต่ละอำเภอในจังหวัดบุรีรัมย์
Route::get('/api/elderly/per-district/buriram', function () {
    $districts = App\Models\Elderly::select('District')->distinct()->where('Province', 'Buriram')->get();
    $data = [];
    foreach ($districts as $district) {
        $count = App\Models\Elderly::where('Province', 'Buriram')->where('District', $district->District)->count();
        $data[] = [
            'district' => $district->District,
            'count' => $count,
        ];
    }
    return response()->json($data);
});

