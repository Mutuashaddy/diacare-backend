<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioData extends Model
{
    use HasFactory  ;   
        protected $fillable = [
            'user_id',
            'full_name',
            'dob',  
            'gender',
            'diabetes_type',    
            'emergency_contact',    
            'doctor`s_number',
            'age',

        ];
}
