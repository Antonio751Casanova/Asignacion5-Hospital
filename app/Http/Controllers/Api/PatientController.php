<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return Patient::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:patients,email',
            'date_of_birth' => 'required|date'
        ]);

        $patient = Patient::create($validated);
        return response()->json($patient, 201);
    }

    public function show(Patient $patient)
    {
        return $patient;
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'string',
            'lastname' => 'string',
            'phone' => 'string',
            'email' => 'email|unique:patients,email,' . $patient->id,
            'date_of_birth' => 'date'
        ]);

        $patient->update($validated);
        return response()->json($patient, 200);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(null, 204);
    }
}