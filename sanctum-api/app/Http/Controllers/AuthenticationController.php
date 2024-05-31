<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    private $user, $doctor, $patient;

    public function __construct() 
    {
        $this->user = new User;
        $this->doctor = new Doctor;
        $this->patient = new Patient;
    }

    public function adminLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required|min:6',
            ],
            [
                'exists.exists' => "The email wasn't registered.",
                'password.min' => 'The password must be at least 6 characters.',
            ]
        );

        $user = $this->user::where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user_id' => $user->id, 'account_type' => $user->account_type], 200);
        }

        return response()->json(['message' => 'Invalid username or password'], 401);
    }

    public function doctorLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required|min:6',
            ],
            [
                'exists.exists' => "The email wasn't registered.",
                'password.min' => 'The password must be at least 6 characters.',
            ]
        );

        $doctor = $this->doctor::where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $doctor->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user_id' => $doctor->id, 'account_type' => $doctor->account_type], 200);
        }

        return response()->json(['message' => 'Invalid username or password'], 401);
    }

    public function patientLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required|min:6',
            ],
            [
                'exists.exists' => "The email wasn't registered.",
                'password.min' => 'The password must be at least 6 characters.',
            ]
        );

        $patient = $this->patient::where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $patient->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user_id' => $patient->id, 'account_type' => $patient->account_type], 200);
        }

        return response()->json(['message' => 'Invalid username or password'], 401);
    }
}
