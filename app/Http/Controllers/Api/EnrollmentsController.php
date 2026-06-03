<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Schedule;
class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Precargamos todas las relaciones con 'with'
        $enrollments = Enrollment::with(['student', 'course', 'teacher', 'schedule'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('student', function ($q) use ($search) {
                    $q->where('last_name', 'LIKE', "%{$search}%")
                      ->orWhere('dni', 'LIKE', "%{$search}%");
                })->orWhereHas('course', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })->get();

        return view('enrollment.index', compact('enrollments'));
    }

    // Mostrar Formulario de Creación con todos los catálogos
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        $teachers = Teacher::all();
        $schedules = Schedule::with('course')->get(); // Incluye el curso en el horario

        return view('enrollment.create', compact('students', 'courses', 'teachers', 'schedules'));
    }

    // Guardar la Matrícula
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => 'required',
            'course_id'       => 'required',
            'teacher_id'      => 'required',
            'schedule_id'     => 'required',
            'semester'        => 'required|string|max:255',
            'enrollment_date' => 'required|date',
            'final_grade'     => 'nullable|numeric|min:0|max:20',
            'status'          => 'required|in:passed,failed,ongoing',
        ]);

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')->with('success', 'Matrícula generada correctamente.');
    }

    // Mostrar Formulario de Edición
    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses = Course::all();
        $teachers = Teacher::all();
        $schedules = Schedule::with('course')->get();

        return view('enrollment.edit', compact('enrollment', 'students', 'courses', 'teachers', 'schedules'));
    }

    // Actualizar la Matrícula
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id'      => 'required',
            'course_id'       => 'required',
            'teacher_id'      => 'required',
            'schedule_id'     => 'required',
            'semester'        => 'required|string|max:255',
            'enrollment_date' => 'required|date',
            'final_grade'     => 'nullable|numeric|min:0|max:20',
            'status'          => 'required|in:passed,failed,ongoing',
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')->with('success', 'Matrícula actualizada con éxito.');
    }

    // Eliminar una Matrícula
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Matrícula eliminada correctamente.');
    }
}
