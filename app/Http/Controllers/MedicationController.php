<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicationController extends Controller
{
    // Save medication
    public function store(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return response()->json([
                "message" => "Unauthorized. Please log in first."
            ], 401);
        }

        // Validate data
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'time_to_take' => 'required',
            'notes' => 'nullable|string',
        ]);

        // Create medication
        $medication = Medication::create([
            'user_id' => Auth::id(),
            'medicine_name' => $validated['medicine_name'],
            'dosage' => $validated['dosage'],
            'time_to_take' => $validated['time_to_take'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            "message" => "Medication saved successfully",
            "data" => $medication
        ], 201);
    }

    // Get user medications
    public function index()
    {
        if (!Auth::check()) {
            return response()->json([
                "message" => "Unauthorized. Please log in first."
            ], 401);
        }

        return Medication::where('user_id', Auth::id())->get();
    }
}
