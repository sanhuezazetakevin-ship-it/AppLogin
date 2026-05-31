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
    public function index()
    {
        $students = Student::all(); 

        return view('student.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
{
    // Retorna la vista donde estará tu formulario de registro
    return view('student.create'); 
}
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function  edit(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

    // 2. Pasas la variable a la vista usando compact('student')
    return view('student.edit', compact('student'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

    // 2. Eliminar el registro de forma definitiva
    $student->delete();

    // 3. Redireccionar a la tabla con un mensaje de éxito para el usuario
    return redirect()->route('students.index')->with('success', 'El estudiante ha sido eliminado correctamente.');
    }
}
