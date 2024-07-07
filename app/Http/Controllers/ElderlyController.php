<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Elderly;

class ElderlyController extends Controller
{
    public function create() //1.สร้างหน้า add
    {
        return view('Elderlys.create');
    }

    public function store(Request $request) //2.ฟังก์ชั่นการเพิ่ม
    {
        $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'NickName' => 'nullable|string',
            'Birthday' => 'required|date',
            'Age' => 'required|integer',
            'Address' => 'required|string',
            'Latitude' => 'required|numeric',
            'Longitude' => 'required|numeric',
            'Phone' => 'required|string'
        ]);

        $elderly = new Elderly();
        $elderly->FirstName = $request->FirstName;
        $elderly->LastName = $request->LastName;
        $elderly->NickName = $request->NickName;
        $elderly->Birthday = $request->Birthday;
        $elderly->Age = $request->Age;
        $elderly->Address = $request->Address;
        $elderly->Latitude = $request->Latitude;
        $elderly->Longitude = $request->Longitude;
        $elderly->Phone = $request->Phone;
        $elderly->save();

        // ตรวจสอบว่าข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($elderly->wasRecentlyCreated) {
            return back()->with('success', 'ลงทะเบียนสำเร็จ');
        } else {
            return back()->with('fail', 'มีข้อผิดพลาดเกิดขึ้นในการลงทะเบียน');
        }
    }
    public function index() //3.หน้ารวมข้อมูล
    {
        $elderly = Elderly::all();
        return view('Elderlys.index',compact('elderly'));
    }

    public function edit($id) //4.หน้าแก้ไข
    {
        $elderly = Elderly::find($id);
        if (!$elderly) {
            return back()->with('fail', 'ไม่พบตำแหน่งที่ต้องการแก้ไข');
        }
        return view('Elderlys.edit', compact('elderly'));
    }
    public function update(Request $request) //5.ฟังก์ชั่นแก้ไข
    {
        $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'NickName' => 'nullable|string',
            'Birthday' => 'required|date',
            'Age' => 'required|integer',
            'Address' => 'required|string',
            'Latitude' => 'required|numeric',
            'Longitude' => 'required|numeric',
            'Phone' => 'required|string'
        ]);

        // ค้นหาข้อมูลผู้สูงอายุที่ต้องการแก้ไข
        $elderly = Elderly::find($request->id);

        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if (!$elderly) {
            return back()->with('fail', 'ไม่พบข้อมูลผู้สูงอายุที่ต้องการแก้ไข');
        }

        // อัพเดตข้อมูลผู้สูงอายุ
        $elderly->FirstName = $request->FirstName;
        $elderly->LastName = $request->LastName;
        $elderly->NickName = $request->NickName;
        $elderly->Birthday = $request->Birthday;
        $elderly->Age = $request->Age;
        $elderly->Address = $request->Address;
        $elderly->Latitude = $request->Latitude;
        $elderly->Longitude = $request->Longitude;
        $elderly->Phone = $request->Phone;

        // บันทึกการเปลี่ยนแปลง
        $saved = $elderly->save();

        // ตรวจสอบการบันทึก
        if ($saved) {
            return back()->with('success', 'แก้ไขข้อมูลผู้สูงอายุเรียบร้อยแล้ว');
        } else {
            return back()->with('fail', 'มีบางอย่างผิดพลาด ไม่สามารถแก้ไขข้อมูลผู้สูงอายุได้');
        }
    }

    public function destroy($id) //6.ฟังก์ชั่นลบข้อมูล
    {
        $elderly = Elderly::find($id);
        // unlink(public_path('images').'/'.$user->profileimage);///เป็นการลบรูปภาพ
        $elderly->delete();

        return back();
    }
}
