<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'equipment_id',
    ];

    public function bodyparts() {
        return $this->belongsToMany(Bodypart::class);
    }

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }
}