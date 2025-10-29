<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BioData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //   Sign Up
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('diacare_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully. Proceed to fill bio data.',
            'user' => $user,
            'token' => $token
        ]);
    }

    // Collect Bio Data
    public function storeBioData(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|min:3',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'diabetes_type' => 'required|string',
            'emergency_contact' => 'required|string',
        ]);

        $bioData = BioData::create([
            'user_id' => $request->user()->id,
            'full_name' => $request->full_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'diabetes_type' => $request->diabetes_type,
            'emergency_contact' => $request->emergency_contact,
        ]);

        return response()->json([
            'message' => 'Bio data saved successfully',
            'bio_data' => $bioData
        ]);
    }

    // Login
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('diacare_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }

    //  User
    public function user(Request $request)
    {
        return $request->user();
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
