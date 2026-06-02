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
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course', 'teacher'])->get();
        return view('enrollment.index', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $students = Student::all();
        $courses = Course::all();
        $teachers = Teacher::all();
        $schedules = Schedule::all();

        
        return view('enrollment.create', compact('students', 'courses', 'teachers', 'schedules'));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, string $id)
    {
       $enrollment = Enrollment::findOrFail($id); 
    
    // 2. Cargar las listas para que se puedan rellenar los desplegables (<select>)
    $students  = Student::all();
    $courses   = Course::all();
    $teachers  = Teacher::all();
    $schedules = Schedule::all();

    // 3. Pasar TODAS las variables a la vista usando compact()
    // ¡Asegúrate de escribir 'enrollment' exactamente igual que en la vista!
    return view('enrollment.edit', compact('enrollment', 'students', 'courses', 'teachers', 'schedules'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
