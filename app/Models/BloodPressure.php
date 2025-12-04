<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class BloodPressure extends Model
{
   use HasFactory  ; 
    protected $table = 'blood_pressure_records';


         protected $fillable = [
        'user_id',
        'systolic',
        'diastolic',
        'measured_at',
        'heart_rate',
        'unit',
        'measurement_position',
        'measurement_arm',
        'measurement_time',

    ];  
}
