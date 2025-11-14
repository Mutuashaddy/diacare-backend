<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Medication extends Model
{
    use  HasFactory;
    protected $fillable = [
        'user_id',
        'medicine_name',
        'dosage',
        'time_to_take',
        'notes',
    ];
}
