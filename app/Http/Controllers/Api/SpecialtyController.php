<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    // Listar todas
    public function index()
    {
        return Specialty::all();
    }

    // Crear nueva
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:specialties,name',
            'description' => 'nullable|string'
        ]);

        $specialty = Specialty::create($validated);
        return response()->json($specialty, 201);
    }

    // Mostrar una específica
    public function show(Specialty $specialty)
    {
        return $specialty;
    }

    // Actualizar
    public function update(Request $request, Specialty $specialty)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string'
        ]);

        $specialty->update($validated);
        return response()->json($specialty, 200);
    }

    // Eliminar
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return response()->json(null, 204);
    }
}