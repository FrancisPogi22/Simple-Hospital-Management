<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    private $doctor;

    public function __construct()
    {
        $this->doctor = new Doctor;
    }

    public function doctors()
    {
        $doctors = $this->doctor->all();

        return response()->json($doctors, 200);
    }

    public function showDoctor($id)
    {
        $doctor = $this->doctor->find($id);

        return response()->json($doctor, 200);
    }

    public function registerDoctors(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required',
                'email' => 'required|email|unique:users,email',
                'address' => 'required',
                'contact' => 'required',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'email.unique' => 'The email has already been taken.',
                'password.min' => 'The password must be at least 6 characters.',
                'password.confirmed' => 'The password confirmation does not match.',
            ]
        );

        $this->doctor->create([
            'fullname' => trim($request->fullname),
            'email' => trim($request->email),
            'address' => trim($request->address),
            'contact' => trim($request->contact),
            'account_type' => 2,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Successfully Registered.'], 201);
    }

    public function editDoctor(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $doctor = $this->doctor::find($id)->first();

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $doctor->update([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'contact' => $request->contact,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Successfully Edited.'], 200);
    }

    public function deleteDoctor($id)
    {
        $this->doctor->find($id)->delete();

        return response()->json([['message' => 'Successfully Removed.']], 200);
    }
}
