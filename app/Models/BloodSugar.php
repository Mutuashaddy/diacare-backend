<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class BloodSugar extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blood_sugar_level',
        'measured_at',
        'unit',
        'measurement_time',
        
    ];
}
