<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;


class TeachersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $teachers = Teacher::when($search, function ($query, $search) {
            return $query->where('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%")
                        ->orWhere('specialty', 'LIKE', "%{$search}%");
        })->get();

        return view('teacher.index', compact('teachers'));
    }

    // Mostrar Formulario de Registro
    public function create()
    {
        return view('teacher.create');
    }

    // Guardar en la Base de Datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'specialty'  => 'required|string|max:255',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Profesor registrado con éxito.');
    }

    // Mostrar Formulario de Edición
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    // Actualizar Profesor
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'specialty'  => 'required|string|max:255',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Datos del profesor actualizados.');
    }

    // Eliminar Profesor
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Profesor eliminado correctamente.');
    }
}
