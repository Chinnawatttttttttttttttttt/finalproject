<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitsAndLogins extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'visited_at',
        'is_login',
        'user_id',
    ];

    // Cast the visited_at attribute to a Carbon instance
    protected $dates = ['visited_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Example of using format() correctly
    public function getFormattedVisitedAtAttribute()
    {
        return $this->visited_at->format('Y-m-d H:i:s');
    }

    public function images()
    {
        return $this->hasMany(NewsVisitor::class); // ปรับเป็นความสัมพันธ์ที่เหมาะสม
    }

    protected $casts = [
        'images' => 'array', // หรือ JSON
    ];

}
