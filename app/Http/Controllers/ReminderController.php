<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
{
    $reminders = Reminder::where('user_id', auth()->id())
                    ->orderBy('time_to_take')
                    ->get();

    return response()->json([
        'message' => 'Reminders fetched successfully',
        'data' => $reminders
    ], 200);
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'time_to_take' => 'required',
        ]);

        $reminder = Reminder::create([
            'user_id' => auth()->id(),
            'medicine_name' => $validated['medicine_name'],
            'time_to_take' => $validated['time_to_take'],
        ]);

        return response()->json([
            'message' => 'Reminder saved successfully',
            'data' => $reminder,
        ], 201);
    }

    
    // DELETE REMINDER
    
    public function destroy($id)
    {
        $reminder = Reminder::where('user_id', auth()->id())
                            ->where('id', $id)
                            ->first();

        if (!$reminder) {
            return response()->json([
                'message' => 'Reminder not found'
            ], 404);
        }

        $reminder->delete();

        return response()->json([
            'message' => 'Reminder deleted successfully'
        ], 200);
    }
}
