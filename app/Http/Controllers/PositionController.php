<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class PositionController extends Controller
{
    public function create() //1.สร้างหน้า add
    {
        return view('positions.create');
    }

    public function store(Request $request) //2.ฟังก์ชั่นการเพิ่ม
    {
        $request->validate([
            // 'ID_Position' => ['required', 'regex:/^\d{3}$/'],
            'position_name' => 'required|regex:/^[\p{Thai}]+[a-zA-Z\p{Thai}]*$/u'
        ], [
            // 'ID_Position.regex' => 'รหัสต้องเป็นตัวเลข 000-999 เท่านั้น',
            'position_name.regex' => 'ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษ และต้องมีอย่างน้อย 1 ตัวอักษรไทย'
        ]);

        $position = new Position();
        // $position->ID_Position = $request->ID_Position;
        $position->position_name = $request->position_name;
        $position->save();

        // ตรวจสอบว่าข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($position->wasRecentlyCreated) {
            return back()->with('success', 'ลงทะเบียนสำเร็จ');
        } else {
            return back()->with('fail', 'มีข้อผิดพลาดเกิดขึ้นในการลงทะเบียน');
        }
     }

    public function index() //3.หน้ารวมข้อมูล
    {
        $position = Position::all();
        return view('Positions.index',compact('position'));
    }

    public function edit($id) // 4. แสดงหน้าแก้ไขตาม ID
    {
        $position = Position::findOrFail($id);
        if (!$position) {
            return back()->with('fail', 'ไม่พบตำแหน่งที่ต้องการแก้ไข');
        }
        return view('Positions.edit', compact('position'));
    }
    public function update(Request $request) // 5. ฟังก์ชั่นการแก้ไข
    {
        // การตรวจสอบค่าที่ส่งมา
        $request->validate([
            'position_name' => 'required|regex:/^[\p{Thai}]+[a-zA-Z\p{Thai}]*$/u'
        ]);
        // ค้นหาตำแหน่งที่ต้องการแก้ไข
        $position = Position::find($request->id);
        if ($position) {
            // อัพเดตข้อมูลตำแหน่ง
            $position->position_name = $request->position_name;
            $answer = $position->save();
            if ($answer) {
                return back()->with('success', 'แก้ไขสำเร็จ');
            } else {
                return back()->with('fail', 'แก้ไขไม่สำเร็จ');
            }
        } else {
            return back()->with('fail', 'ไม่พบตำแหน่งที่ต้องการแก้ไข');
        }
    }

    public function destroy($id)
    {
        $position = Position::find($id);
        // unlink(public_path('images').'/'.$user->profileimage);///เป็นการลบรูปภาพ
        $position->delete();

        return back();
    }
}

