<?php

namespace App\Http\Controllers;

use App\Models\BloodSugar;
use Illuminate\Http\Request;

class BloodSugarController extends Controller
{
    public function index()
    {
        $records = BloodSugar::where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $records
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sugar_level' => 'required|numeric',
            'unit' => 'required|in:mmol/L,mg/dL',
            'measurement_time' => 'required|string',
            'measured_at' => 'required|string|in:Morning,Noon,Afternoon,Evening,Night'
        ]);

        $record = BloodSugar::create([
            'user_id' => auth()->id(),
            'sugar_level' => $validated['sugar_level'],
            'unit' => $validated['unit'],
            'measurement_time' => $validated['measurement_time'],
            'measured_at' => $validated['measured_at'],
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Blood sugar record saved successfully.',
            'data' => $record
        ]);
    }

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
            'measurement_time' => 'nullable|string',
            'measured_at' => 'nullable|string|in:Morning,Noon,Afternoon,Evening,Night'
        ]);

        $record->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Record updated successfully.',
            'data' => $record
        ]);
    }

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
