<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Department;
use App\Models\Elderly;
use App\Models\Position;

class UserController extends Controller
{
    public function create() //1.หน้าเพิ่ม User
    {
        $dpt = Department::pluck('department_name', 'id');
        $position = Position::pluck('position_name', 'id');
        $selectedID = 1;
        return view('Users.create', compact('dpt', 'position', 'selectedID'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'NickName' => 'nullable|string|max:255',
            'Username' => 'required|digits:13|unique:users',
            'Password' => 'required|string|min:6',
            'Email' => 'required|string|email|max:255|unique:users',
            'Address' => 'required|string|max:255',
            'Phone' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'image_Profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null; // กำหนดค่าเริ่มต้นให้ $imageName เป็น null

        if ($request->hasFile('image_Profile')) { // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
            $image = $request->file('image_Profile');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
        }

        $user = new User();
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->NickName = $request->NickName;
        $user->Username = $request->Username;
        $user->Password = Hash::make($request->Password);
        $user->Email = $request->Email;
        $user->Address = $request->Address;
        $user->Phone = $request->Phone;
        $user->department_id = $request->department_id;
        $user->position_id = $request->position_id;
        $user->image_Profile = $imageName;

        $save = $user->save();

        if ($save) {
            return back()->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } else {
            return back()->with('fail', 'มีบางอย่างผิดพลาด');
        }
    }

    public function index() //3.หน้ารวมข้อมูล
    {
        $users = User::all();
        $dpt = Department::all();
        $position = Position::all();
        $selectedID = 1;
        return view('users.index', compact('users','dpt','position','selectedID'));
    }

    public function edit($id) // 4. แสดงหน้าแก้ไขตาม ID
    {
        $user = User::find($id);
        $dpt = Department::pluck('department_name','id');
        $position = Position::pluck('position_name', 'id');

        if (!$user) {
            return back()->with('fail', 'ไม่พบผู้ใช้งานที่ต้องการแก้ไข');
        }

        return view('Users.edit', compact('user', 'dpt', 'position'));
    }
    public function update(Request $request) //5.ฟังก์ชั่นแก้ไข
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'NickName' => 'nullable|string|max:255',
            'Username' => 'required|digits:13',
            'Password' => 'nullable|string|min:6',
            'Email' => 'required|string|email|max:255',
            'Address' => 'required|string|max:255',
            'Phone' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'image_Profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($request->id);

        if (!$user) {
            return back()->with('fail', 'ไม่พบข้อมูลผู้ใช้ที่ต้องการแก้ไข');
        }

        if ($request->hasFile('image_Profile')) {
            $imagePath = $request->file('image_Profile')->store('profile_images', 'public');
            $user->image_Profile = $imagePath;
        }

        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->NickName = $request->NickName;
        $user->Username = $request->Username;
        if($request->Password) {
            $user->Password = Hash::make($request->Password);
        }
        $user->Email = $request->Email;
        $user->Address = $request->Address;
        $user->Phone = $request->Phone;
        $user->department_id = $request->department_id;
        $user->position_id = $request->position_id;

        $save = $user->save();

        if ($save) {
            return back()->with('success', 'แก้ไขข้อมูลสำเร็จ');
        } else {
            return back()->with('fail', 'มีบางอย่างผิดพลาด');
        }
    }

    public function destroy($id) //6.ฟังก์ชั่นลบข้อมูล
    {
        $user = User::find($id);
        unlink(public_path('images').'/'.$user->image_Profile);///เป็นการลบรูปภาพ
        $user->delete();

        return back();
    }
}
