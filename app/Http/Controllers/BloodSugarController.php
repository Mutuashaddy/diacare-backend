<?php

namespace App\Http\Controllers;

use App\Models\BloodSugar;
use Illuminate\Http\Request;

class BloodSugarController extends Controller
{
    
    /**
     * Display all blood sugar records for logged-in user
     */
    public function index()
    {
        $records = BloodSugar::where('user_id', auth()->id())
            ->orderBy('measured_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $records
        ]);
    }

    /**
     * Store new record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sugar_level' => 'required|numeric',
            'unit' => 'required|in:mmol/L,mg/dL',
            'measurement_time' => 'required|in:Fasting,Before Meal,After Meal,Random,Before Sleep',
            'measured_at' => 'nullable|date'
        ]);

        $record = BloodSugar::create([
            'user_id' => auth()->id(),
            'sugar_level' => $validated['sugar_level'], 
            'unit' => $validated['unit'],
            'measurement_time' => $validated['measurement_time'],
            'measured_at' => $validated['measured_at'] ?? now(),
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Blood sugar record saved successfully.',
            'data' => $record
        ]);
    }

    /**
     * Show a single record
     */
    public function show($id)
    {
        $record = BloodSugar::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $record
        ]);
    }

    /**
     * Update record
     */
    public function update(Request $request, $id)
    {
        $record = BloodSugar::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found'
            ], 404);
        }

        $validated = $request->validate([
            'sugar_level' => 'nullable|numeric',
            'unit' => 'nullable|in:mmol/L,mg/dL',
            'measurement_time' => 'nullable|in:Fasting,Before Meal,After Meal,Random,Before Sleep',
            'measured_at' => 'nullable|date',
        ]);

        $record->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Record updated successfully.',
            'data' => $record
        ]);
    }

    /**
     * Delete record
     */
    public function destroy($id)
    {
        $record = BloodSugar::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found'
            ], 404);
        }

        $record->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Record deleted successfully.'
        ]);
    }
}
