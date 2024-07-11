<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreTAI extends Model
{
    use HasFactory;

    protected $table = 'score_tais';

    protected $fillable = [
        'elderly_id',
        'mobility',
        'confuse',
        'feed',
        'toilet',
        'user_id',
    ];

    public function elderly()
    {
        return $this->belongsTo(Elderly::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // ScoreTAI model
    public function group()
    {
        return $this->hasOne(Group::class, 'elderly_id', 'elderly_id');
    }

    // Group model
    public function score()
    {
        return $this->belongsTo(ScoreTAI::class, 'elderly_id', 'elderly_id');
    }

}
