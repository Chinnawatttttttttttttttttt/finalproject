<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    // Relationship กับ Position
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

}
