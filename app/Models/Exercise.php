<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'sets', 'repetitions'
    ];

    public function workouts()
    {
        return $this->belongsToMany(Workout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
