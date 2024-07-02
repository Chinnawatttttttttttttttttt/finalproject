<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;

class UserController extends Controller
{
    public function create()
    {
        return view('Users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'NickName' => 'nullable|string|max:255',
            'Username' => 'required|string|max:255|unique:users',
            'Password' => 'required|string|min:8',
            'Email' => 'required|string|email|max:255|unique:users',
            'Address' => 'required|string|max:255',
            'Phone' => 'required|string|max:20',
            'DPT_id' => 'required|integer',
            'department_name' => 'required|string|max:255',
            'PT_id' => 'required|integer',
            'position_name' => 'required|string|max:255',
            'image_Profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_Profile')) {
            $imagePath = $request->file('image_Profile')->store('profile_images', 'public');
        }

        // สร้างผู้ใช้ใหม่และบันทึกลงฐานข้อมูล
        $user = new User();
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->NickName = $request->NickName;
        $user->Username = $request->Username;
        $user->Password = bcrypt($request->Password);
        $user->Email = $request->Email;
        $user->Address = $request->Address;
        $user->Phone = $request->Phone;
        $user->DPT_id = $request->DPT_id;
        $user->department_name = $request->department_name;
        $user->PT_id = $request->PT_id;
        $user->position_name = $request->position_name;
        $user->image_Profile = $imagePath;

        $save = $user->save();

        // ตรวจสอบการบันทึก
        if ($save) {
            return back()->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } else {
            return back()->with('fail', 'มีบางอย่างผิดพลาด');
        }
    }
}
