<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BiodataController extends Controller
{

     //Store biodata
     
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:Male,Female,Other',
            'diabetes_type' => 'required|string',
            'emergency_contact' => 'required|string|max:20',
            'doctor_number' => 'nullable|string|max:20',
        ]);

        // Calculate age automatically from date of birth
        $age = Carbon::parse($validated['dob'])->age;

        // Add the user_id and age to the validated data
        $validated['user_id'] = Auth::id();
        $validated['age'] = $age;

        // Create or update biodata
        $biodata = Biodata::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return response()->json([
            'message' => 'Biodata saved successfully!',
            'data' => $biodata
        ], 201);
    }

    
     //Show the logged-in biodata
     
    public function show()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            return response()->json(['message' => 'No biodata found'], 404);
        }

        // Recalculate age dynamically before returning
        $biodata->age = Carbon::parse($biodata->dob)->age;

        return response()->json($biodata);
    }

    
     // Update the  biodata
    
    public function update(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'dob' => 'sometimes|date',
            'gender' => 'sometimes|string|in:Male,Female,Other',
            'diabetes_type' => 'sometimes|string',
            'emergency_contact' => 'sometimes|string|max:20',
            'doctor_number' => 'nullable|string|max:20',
        ]);

        // If dob is updated, recalculate age
        if (isset($validated['dob'])) {
            $validated['age'] = Carbon::parse($validated['dob'])->age;
        }

        $biodata->update($validated);

        return response()->json([
            'message' => 'Biodata updated successfully!',
            'data' => $biodata
        ]);
    }

    
     //Delete  biodata
     
    public function destroy()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            return response()->json(['message' => 'No biodata to delete'], 404);
        }

        $biodata->delete();

        return response()->json(['message' => 'Biodata deleted successfully!']);
    }
}
