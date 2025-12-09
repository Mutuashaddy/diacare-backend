<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'dob',
        'email',
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function bioData()
    {
        return $this->hasOne(BioData::class);
    }

    public function bloodSugarRecords()
    {
        return $this->hasMany(BloodSugar::class);
    }

    public function bloodPressureRecords()
    {
        return $this->hasMany(BloodPressure::class);
    }

   
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
