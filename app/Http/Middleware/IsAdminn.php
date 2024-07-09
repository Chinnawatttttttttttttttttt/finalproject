<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // ตรวจสอบว่าผู้ใช้งานมีการล็อกอินและมี position_id เป็น '1' (ตัวอย่าง)
        if ($user && $user->position_id == 1) {
            return $next($request);
        }

        // ถ้าไม่ผ่านการตรวจสอบ กลับไปยังหน้า error พร้อมข้อความแจ้งเตือน
        return redirect('error')->with('fail', 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้');
    }
}
