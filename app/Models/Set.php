<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workoutlog_id',
        'weight',
        'reps',
    ];

    public function workoutlog() {
        return $this->belongsTo(Workoutlog::class);
    }

}
