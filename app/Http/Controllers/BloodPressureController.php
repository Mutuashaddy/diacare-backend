<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
use Illuminate\Http\Request;

class BloodPressureController extends Controller
{
    
     //Display all blood pressure records for the logged-in user
     
    public function index()
    {
        $records = BloodPressure::where('user_id', auth()->id())
            ->orderBy('measured_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $records,
        ]);
    }

    
      //Store a new blood pressure record
     
    public function store(Request $request)
    {
        $validated = $request->validate([
            'systolic' => 'required|integer',
            'diastolic' => 'required|integer',
            'heart_rate' => 'nullable|integer',
            'unit' => 'nullable|in:mmHg',
            'measurement_position' => 'nullable|in:Sitting,Standing,Lying Down',
            'measurement_arm' => 'nullable|in:Left Arm,Right Arm',
            'measurement_time' => 'nullable|in:Morning,Evening,Before Medication,After Medication,Random',
            'measured_at' => 'nullable|date',
        ]);

        $record = BloodPressure::create(array_merge($validated, [
            'user_id' => auth()->id(),
            'unit' => $validated['unit'] ?? 'mmHg',
            'measurement_position' => $validated['measurement_position'] ?? 'Sitting',
            'measurement_arm' => $validated['measurement_arm'] ?? 'Left Arm',
            'measurement_time' => $validated['measurement_time'] ?? 'Random',
            'measured_at' => $validated['measured_at'] ?? now(),
        ]));

        return response()->json([
            'status' => 201,
            'message' => 'Blood pressure record saved successfully.',
            'data' => $record,
        ]);
    }

    
     //Display a single blood pressure record
     
    public function show($id)
    {
        $record = BloodPressure::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $record,
        ]);
    }

    //Update a blood pressure record
     
    public function update(Request $request, $id)
    {
        $record = BloodPressure::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found',
            ], 404);
        }

        $validated = $request->validate([
            'systolic' => 'nullable|integer',
            'diastolic' => 'nullable|integer',
            'heart_rate' => 'nullable|integer',
            'unit' => 'nullable|in:mmHg',
            'measurement_position' => 'nullable|in:Sitting,Standing,Lying Down',
            'measurement_arm' => 'nullable|in:Left Arm,Right Arm',
            'measurement_time' => 'nullable|in:Morning,Evening,Before Medication,After Medication,Random',
            'measured_at' => 'nullable|date',
        ]);

        $record->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Blood pressure record updated successfully.',
            'data' => $record,
        ]);
    }

    //Delete a blood pressure record
     
    public function destroy($id)
    {
        $record = BloodPressure::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found',
            ], 404);
        }

        $record->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Blood pressure record deleted successfully.',
        ]);
    }
}
