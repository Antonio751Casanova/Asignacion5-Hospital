<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Incluimos datos de paciente y doctor
        return Appointment::with(['patient', 'doctor'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'scheduled_at' => 'required|date',
            'status' => 'in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string'
        ]);

        $appointment = Appointment::create($validated);
        return response()->json($appointment, 201);
    }

    public function show(Appointment $appointment)
    {
        return $appointment->load(['patient', 'doctor']);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'exists:patients,id',
            'doctor_id' => 'exists:doctors,id',
            'scheduled_at' => 'date',
            'status' => 'in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string'
        ]);

        $appointment->update($validated);
        return response()->json($appointment, 200);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(null, 204);
    }
}