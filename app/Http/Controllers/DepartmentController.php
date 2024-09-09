<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function create() //1. สร้างหน้า add
    {
        return view('Department.create');
    }

    public function store(Request $request) //2. ฟังก์ชันการเพิ่ม
    {
        $request->validate([
            'department_name' => 'required|regex:/^[\p{Thai}a-zA-Z]+$/u'
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

    public function index() //3. หน้ารวมข้อมูล
    {
        $dpt = Department::all();
        return view('Department.index', compact('dpt'));
    }

    public function edit($id) //4. แสดงหน้าแก้ไขตาม ID
    {
        $dpt = Department::findOrFail($id);
        return view('Department.edit', compact('dpt'));
    }

    public function update(Request $request, $id) //5. ฟังก์ชันการแก้ไข
    {
        $request->validate([
            'department_name' => 'required|regex:/^[\p{Thai}a-zA-Z]+$/u'
        ], [
            'department_name.regex' => 'ชื่อต้องเป็นตัวอักษรไทยหรือภาษาอังกฤษ และต้องมีอย่างน้อย 1 ตัวอักษรไทย'
        ]);

        $dpt = Department::findOrFail($id);
        $dpt->department_name = $request->department_name;

        if ($dpt->save()) {
            return back()->with('success', 'แก้ไขสำเร็จ');
        } else {
            return back()->with('fail', 'แก้ไขไม่สำเร็จ');
        }
    }

    public function destroy($id)
    {
        $dpt = Department::findOrFail($id);
        $dpt->delete();

        return back()->with('fail', 'ลบข้อมูลสำเร็จ');
    }
}
