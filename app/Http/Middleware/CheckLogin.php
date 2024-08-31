<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VisitsAndLogins;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // บันทึกข้อมูลการเข้าชม
        $visit = new VisitsAndLogins();
        $visit->ip_address = $request->ip();
        $visit->is_login = Auth::check(); // ถ้ามีการเข้าสู่ระบบ is_login จะเป็น true
        if (Auth::check()) {
            $visit->user_id = Auth::id();
        }
        $visit->save();

        // ถ้าไม่มีการเข้าสู่ระบบให้รีไดเร็กต์ไปหน้า login
        if (!Auth::check()) {
            return redirect('login')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        return $next($request);
    }
}
