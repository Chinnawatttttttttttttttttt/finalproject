<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function create() //1.สร้างหน้า add
    {
        return view('Department.create');
    }

    public function store(Request $request) //2.ฟังก์ชั่นการเพิ่ม
    {
        $request->validate([
            'department_name' => 'required|regex:/^[\p{Thai}]+[a-zA-Z\p{Thai}]*$/u'
        ], [
            'department_name.regex' => 'ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษ และต้องมีอย่างน้อย 1 ตัวอักษรไทย'
        ]);

        $dpt = new Department();
        $dpt->department_name = $request->department_name;
        $dpt->save();

        // ตรวจสอบว่าข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($dpt->wasRecentlyCreated) {
            return back()->with('success', 'ลงทะเบียนสำเร็จ');
        } else {
            return back()->with('fail', 'มีข้อผิดพลาดเกิดขึ้นในการลงทะเบียน');
        }
    }

    public function index() //3.หน้ารวมข้อมูล
    {
        $dpt = Department::all();
        return view('Department.index',compact('dpt'));
    }

    public function edit($id) // 4. แสดงหน้าแก้ไขตาม ID
    {
        $dpt = Department::find($id);
        if (!$dpt) {
            return back()->with('fail', 'ไม่พบตำแหน่งที่ต้องการแก้ไข');
        }
        return view('Department.edit', compact('dpt'));
    }
    public function update(Request $request) // 5. ฟังก์ชั่นการแก้ไข
    {
        // การตรวจสอบค่าที่ส่งมา
        $request->validate([
            'department_name' => 'required|regex:/^[\p{Thai}]+[a-zA-Z\p{Thai}]*$/u'
        ]);
        // ค้นหาตำแหน่งที่ต้องการแก้ไข
        $dpt = Department::find($request->id);
        if ($dpt) {
            // อัพเดตข้อมูลตำแหน่ง
            $dpt->department_name = $request->department_name;
            $answer = $dpt->save();
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
        $dpt = Department::find($id);
        // unlink(public_path('images').'/'.$user->profileimage);///เป็นการลบรูปภาพ
        $dpt->delete();

        return back();
    }

}
