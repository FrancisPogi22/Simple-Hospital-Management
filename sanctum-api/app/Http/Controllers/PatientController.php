<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    private $patient;

    public function __construct()
    {
        $this->patient = new Patient;
    }

    public function patients()
    {
        $patients = $this->patient->all();

        return response()->json($patients, 200);
    }

    public function showPatient($id)
    {
        $patient = $this->patient->find($id);

        return response()->json($patient, 200);
    }

    public function registerPatients(Request $request)
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

        $this->patient->create([
            'fullname' => trim($request->fullname),
            'email' => trim($request->email),
            'address' => trim($request->address),
            'contact' => trim($request->contact),
            'account_type' => 3,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Successfully Registered.'], 201);
    }

    public function editPatient(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $patient = $this->patient::find($id)->first();

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->update([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'contact' => $request->contact,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Successfully Edited.'], 200);
    }

    public function deletePatient($id)
    {
        $this->patient->find($id)->delete();

        return response()->json([['message' => 'Successfully Removed.']], 200);
    }
}
