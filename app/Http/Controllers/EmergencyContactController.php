<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyContact;
use Illuminate\Support\Facades\Auth;

class EmergencyContactController extends Controller
{
    // Save emergency contacts
    public function store(Request $request)
    {
        $request->validate([
            'caregiver_name' => 'nullable|string',
            'caregiver_number' => 'nullable|string',
            'doctor_name' => 'nullable|string',
            'doctor_number' => 'nullable|string',
            'hospital_name' => 'nullable|string',
            'hospital_number' => 'nullable|string',
            'hospital_location' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Save or update if record exists
        $contact = EmergencyContact::updateOrCreate(
            ['user_id' => $user->id],
            $request->all() + ['user_id' => $user->id]
        );

        return response()->json([
            'message' => 'Emergency contacts saved successfully',
            'data' => $contact
        ], 201);
    }

    // Fetch emergency contacts
    public function show()
    {
        $contact = EmergencyContact::where('user_id', Auth::id())->first();

        return response()->json($contact);
    }
}
