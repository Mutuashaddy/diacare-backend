<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caregiver_name',
        'caregiver_number',
        'doctor_name',
        'doctor_number',
        'hospital_name',
        'hospital_number',
        'hospital_location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
