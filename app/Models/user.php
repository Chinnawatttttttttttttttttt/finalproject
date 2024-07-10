<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable;

    // กำหนดความสัมพันธ์
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    // กำหนดฟิลด์ที่สามารถรับค่าได้แบบกลุ่ม
    protected $fillable = [
        'FirstName', 'LastName', 'Email', 'department_id', 'position_id', 'password',
    ];

    // กำหนดฟิลด์ที่ต้องซ่อน
    protected $hidden = [
        'password', 'remember_token',
    ];

    // กำหนดการแปลงข้อมูลสำหรับแอตทริบิวต์
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
