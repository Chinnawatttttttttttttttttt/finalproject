<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($fieldType, $request->login)->first();

        if (!$user) {
            return back()->with('fail', 'User not found');
        }

        if (!Hash::check($request->password, $user->Password)) {
            return back()->with('fail', 'Password is incorrect');
        }

        Auth::login($user);

        session(['position_id' => $user->position_id]);

        // // ถ้า position_id เท่ากับ 3 ให้ redirect ไปที่หน้า /profile
        // if ($user->position_id == 3) {
        //     return redirect('/all-elderly');
        // }

        // // Redirect ไปที่หน้า dashboard หรือหน้าที่ตั้งไว้ก่อนหน้า
        return redirect()->intended('/dashboard');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();

        // Invalidate the session to prevent session fixation attacks
        $request->session()->invalidate();

        // Regenerate the CSRF token to ensure that old tokens are invalidated
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
