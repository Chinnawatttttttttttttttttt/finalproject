<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;

class UserController extends Controller
{
    public function create()
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

        $imagePath = null;
        if ($request->hasFile('image_Profile')) {
            $imagePath = $request->file('image_Profile')->store('profile_images', 'public');
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
        $user->image_Profile = $imagePath;

        $save = $user->save();

        if ($save) {
            return back()->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } else {
            return back()->with('fail', 'มีบางอย่างผิดพลาด');
        }
    }
    public function index()
    {
        $users = User::all();
        $dpt = Department::all();
        $position = Position::all();
        return view('users.index', compact('users','dpt','position'));
    }
}
