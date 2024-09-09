<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        //  dd($request->all());

        $request->validate([
            'Title' => 'required|string|max:255',
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'NickName' => 'nullable|string|max:255',
            'Username' => 'required|digits:13|unique:users',
            'Password' => 'required|string|min:6',
            'Email' => 'required|string|email|max:255|unique:users',
            'Address' => 'required|string',
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
        $user->Title = $request->Title;
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
        return view('users.index', compact('users','dpt','position'));
    }

    public function edit($id) // 4. แสดงหน้าแก้ไขตาม ID
    {
        $user = User::find($id);
        $dpt = Department::pluck('department_name','id');
        $position = Position::pluck('position_name', 'id');

        // Split address
        $address = $user->Address;
        $addressParts = preg_split('/\s+/', $address); // Split by whitespace

        // Assuming the address structure is defined:
        $houseNumber = $addressParts[1] ?? '';
        $village = $addressParts[3] ?? '';
        $subdistrict = $addressParts[5] ?? '';
        $district = $addressParts[7] ?? '';
        $province = $addressParts[9] ?? '';
        $postalCode = $addressParts[11] ?? '';

        if (!$user) {
            return back()->with('fail', 'ไม่พบผู้ใช้งานที่ต้องการแก้ไข');
        }

        return view('Users.edit', compact('user', 'dpt', 'position','houseNumber', 'village', 'subdistrict', 'district', 'province', 'postalCode'));
    }

    public function update(Request $request, $id)
    {
        //  dd($request->all());

        $request->validate([
            'Title' => 'required|string|max:255',
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

        $user = User::find($id);

        if (!$user) {
            return back()->with('fail', 'ไม่พบข้อมูลผู้ใช้ที่ต้องการแก้ไข');
        }

        if ($request->hasFile('image_Profile')) {
            $imagePath = $request->file('image_Profile')->store('images', 'public');
            $user->image_Profile = $imagePath;
        }

        $user->Title = $request->input('Title');
        $user->FirstName = $request->input('FirstName');
        $user->LastName = $request->input('LastName');
        $user->NickName = $request->input('NickName');
        $user->Username = $request->input('Username');
        if ($request->has('Password')) {
            $user->Password = Hash::make($request->input('Password'));
        }
        $user->Email = $request->input('Email');
        $user->Address = $request->input('Address');
        $user->Phone = $request->input('Phone');
        $user->department_id = $request->input('department_id');
        $user->position_id = $request->input('position_id');

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

    public function profile()
    {
        $user = Auth::user();

        // Split address
        $address = $user->Address;
        $addressParts = preg_split('/\s+/', $address); // Split by whitespace

        // Assuming the address structure is defined:
        $houseNumber = $addressParts[1] ?? '';
        $village = $addressParts[3] ?? '';
        $subdistrict = $addressParts[5] ?? '';
        $district = $addressParts[7] ?? '';
        $province = $addressParts[9] ?? '';
        $postalCode = $addressParts[11] ?? '';

        if (Auth::check()) {
            $user = Auth::user();
            return view('Users.profile', ['user' => $user],compact('user', 'houseNumber', 'village', 'subdistrict', 'district', 'province', 'postalCode'));
        } else {
            // Handle case when user is not logged in
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบเพื่อดูโปรไฟล์ของคุณ');
        }

    }

    public function updateProfile(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูลที่รับเข้ามา
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Address' => 'required|string|max:255',
            'Phone' => 'required|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // รับผู้ใช้ที่กำลังเข้าสู่ระบบ
        $user = Auth::user();

        // อัปเดตข้อมูลผู้ใช้
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->Email = $request->Email;
        $user->Address = $request->Address;
        $user->Phone = $request->Phone;

        // อัปเดตรูปโปรไฟล์หากมีการอัปโหลด
        if ($request->hasFile('profile_image')) {
            // ลบรูปโปรไฟล์เก่าออกจากระบบ
            if ($user->image_Profile) {
                Storage::delete('public/images/' . $user->image_Profile);
            }

            // บันทึกรูปโปรไฟล์ใหม่
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $user->image_Profile = $imageName;
        }

        // บันทึกข้อมูลลงฐานข้อมูล
        $user->save();

        // เปลี่ยนเส้นทางกลับไปยังหน้าที่ต้องการพร้อมแสดงข้อความสำเร็จ
        return redirect()->back()->with('success', 'อัปเดตโปรไฟล์สำเร็จ');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->Password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว');
    }
}
