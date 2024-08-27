<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsVisitor extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'images']; // รวมฟิลด์ `images`

    // แปลงค่าของฟิลด์ `images` เป็น array เมื่อต้องการใช้งาน
    public function getImagesAttribute($value)
    {
        return explode(',', $value); // แปลงจากคอมม่าแยกเป็น array
    }

    // แปลง array กลับเป็นคอมม่าแยกเมื่อบันทึก
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = is_array($value) ? implode(',', $value) : $value;
    }

}
