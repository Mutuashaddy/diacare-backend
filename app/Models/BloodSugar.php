<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodSugar extends Model
{
    use HasFactory;

    protected $table = 'blood_sugar_records'; 

    protected $fillable = [
        'user_id',
        'sugar_level',
        'measured_at',
        'unit',
        'measurement_time',
    ];
}
