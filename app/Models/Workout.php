<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date','rating','remarks',];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workoutlogs() {
        return $this->hasMany(Workoutlog::class);
    }

}
