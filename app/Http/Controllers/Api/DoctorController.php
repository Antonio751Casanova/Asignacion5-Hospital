<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // Traemos también la especialidad
        return Doctor::with('specialty')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'specialty_id' => 'required|exists:specialties,id'
        ]);

        $doctor = Doctor::create($validated);
        return response()->json($doctor, 201);
    }

    public function show(Doctor $doctor)
    {
        return $doctor->load('specialty');
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'string',
            'lastname' => 'string',
            'phone' => 'string',
            'specialty_id' => 'exists:specialties,id'
        ]);

        $doctor->update($validated);
        return response()->json($doctor, 200);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(null, 204);
    }
}