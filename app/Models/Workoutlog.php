<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workoutlog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exercise_id',
        'workout_id',
        'order',
    ];

    public function workout() {
        return $this->belongsTo(Workout::class);
    }

    public function exercise() {
        return $this->belongsTo(Exercise::class);
    }

    public function sets() {
        return $this->hasMany(Set::class);
    }

}
