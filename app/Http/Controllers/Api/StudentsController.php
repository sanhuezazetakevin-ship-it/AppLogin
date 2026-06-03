<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Capturamos lo que el usuario escriba en un input de búsqueda llamado 'search'
        $search = $request->input('search');

        // Si hay una búsqueda, filtramos; si no, trae todos
        $students = Student::when($search, function ($query, $search) {
            return $query->where('dni', 'LIKE', "%{$search}%")
                        ->orWhere('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
        })->get();

        // Retorna la vista index (donde harás tu tabla) pasándole los estudiantes
        return view('student.index', compact('students'));
    }

    // Muestra el formulario de creación (el que ya tienes)
    public function create()
    {
        return view('student.create');
    }

    // Guarda el nuevo estudiante
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'dni'           => 'required|string|size:8|unique:students,dni',
            'date_of_birth' => 'required|date',
            'email'         => 'required|email|max:255|unique:students,email',
            'phone_number'  => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Estudiante registrado correctamente.');
    }

    // 2. MOSTRAR FORMULARIO DE EDICIÓN (Busca automáticamente por ID)
    public function edit(Student $student)
    {
        // Laravel busca al estudiante por su ID en la BD y lo pasa a la vista de edición
        return view('student.edit', compact('student'));
    }

    // 3. ACTUALIZAR LOS DATOS EN LA BD
    public function update(Request $request, Student $student)
    {
        // Validamos (con la excepción de que el DNI y Email actual pertenecen a este alumno)
        $validated = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'dni'           => 'required|string|size:8|unique:students,dni,' . $student->id,
            'date_of_birth' => 'required|date',
            'email'         => 'required|email|max:255|unique:students,email,' . $student->id,
            'phone_number'  => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
        ]);

        // Guardamos los cambios
        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Estudiante actualizado con éxito.');
    }
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        // Eliminar el registro de forma definitiva
        $student->delete();

        // Redireccionar a la tabla con un mensaje de éxito para el usuario
        return redirect()->route('students.index')->with('success', 'El estudiante ha sido eliminado correctamente.');
    }
}