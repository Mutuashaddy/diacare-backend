<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'medication_id',
        'user_id',
        'reminder_time',
        'repeat_daily',
        'active',
    ];

    // Relation: Reminder belongs to a medication
    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }

    // Relation: Reminder belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
