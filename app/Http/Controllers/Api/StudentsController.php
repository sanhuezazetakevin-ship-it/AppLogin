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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna la vista donde estará tu formulario de registro
        return view('student.create'); 
    }

    /**
     * Store a newly created resource in storage.
     * (AQUÍ SE GUARDA EL ESTUDIANTE)
     */
    public function store(Request $request)
    {
        // 1. Validar los datos que vienen del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer'
        ]);

        // 2. Guardar en la base de datos
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
        ]);

        // 3. Redireccionar a la lista con un mensaje de éxito
        return redirect()->route('students.index')->with('success', 'El estudiante ha sido guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        // Pasas la variable a la vista usando compact('student')
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     * (AQUÍ SE MODIFICA EL ESTUDIANTE)
     */
    public function update(Request $request, string $id)
    {
        // 1. Buscar al estudiante que se va a modificar
        $student = Student::findOrFail($id);

        // 2. Validar los nuevos datos (el email ignora el ID actual para que no choque consigo mismo)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'age' => 'required|integer'
        ]);

        // 3. Actualizar los datos en la base de datos
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
        ]);

        // 4. Redireccionar con mensaje de éxito
        return redirect()->route('students.index')->with('success', 'El estudiante ha sido modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     * (AQUÍ SE ELIMINA EL ESTUDIANTE)
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        // Eliminar el registro de forma definitiva
        $student->delete();

        // Redireccionar a la tabla con un mensaje de éxito para el usuario
        return redirect()->route('students.index')->with('success', 'El estudiante ha sido eliminado correctamente.');
    }
}