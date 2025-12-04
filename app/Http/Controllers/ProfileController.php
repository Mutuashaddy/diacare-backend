<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Get the authenticated user's profile
     */
    public function profile(Request $request)
    {
        return response()->json([
            'status' => 200,
            'data' => $request->user()
        ]);
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'DateofBirth' => 'sometimes|date',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        if ($request->has('full_name')) $user->full_name = $request->full_name;
        if ($request->has('DateofBirth')) $user->DateofBirth = $request->DateofBirth;
        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('password')) $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }
}
