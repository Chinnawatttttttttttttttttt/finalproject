<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // ตรวจสอบว่าผู้ใช้มีค่าของ position_id เป็น 1 หรือ 2
        if ($user && ($user->position_id === 1 || $user->position_id === 2)) {
            return $next($request);
        }

        // หากผู้ใช้ไม่มีสิทธิ์เข้าถึง ให้เปลี่ยนเส้นทางไปยังหน้า error
        return redirect('error')->with('fail', 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้');
    }
}
