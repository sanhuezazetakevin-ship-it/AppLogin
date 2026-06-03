<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;


class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Busca coincidencias por nombre o por el código único del curso
        $courses = Course::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('code', 'LIKE', "%{$search}%");
        })->get();

        return view('course.index', compact('courses'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        return view('course.create');
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:255|unique:courses,code',
            'credits'     => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Curso registrado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    // Actualizar los datos del curso
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:255|unique:courses,code,' . $course->id,
            'credits'     => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado con éxito.');
    }

    // Eliminar un curso
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente.');
    }
}
