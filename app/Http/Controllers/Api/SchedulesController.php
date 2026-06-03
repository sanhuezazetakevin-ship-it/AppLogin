<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Course;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // 'with(['course'])' precarga los cursos para evitar consultas lentas
        $schedules = Schedule::with(['course'])
            ->when($search, function ($query, $search) {
                return $query->where('number_of_classroom', 'LIKE', "%{$search}%")
                             ->orWhereHas('course', function ($q) use ($search) {
                                $q->where('name', 'LIKE', "%{$search}%");
                             });
            })->get();

        return view('schedule.index', compact('schedules'));
    }

    // Mostrar formulario de registro (Pasamos los cursos para el select)
    public function create()
    {
        $courses = Course::all();
        return view('schedule.create', compact('courses'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'           => 'required|exists:courses,id', // Valida que el curso exista en la tabla 'courses'
            'day_of_week'         => 'required|string|max:255',
            'start_time'          => 'required',
            'end_time'            => 'required',
            'number_of_classroom' => 'required|string|max:255',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Horario asignado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Schedule $schedule)
    {
        $courses = Course::all();
        return view('schedule.edit', compact('schedule', 'courses'));
    }

    // Actualizar los datos del horario
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'course_id'           => 'required|exists:courses,id',
            'day_of_week'         => 'required|string|max:255',
            'start_time'          => 'required',
            'end_time'            => 'required',
            'number_of_classroom' => 'required|string|max:255',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Horario actualizado con éxito.');
    }

    // Eliminar un horario
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Horario eliminado correctamente.');
    }
}
