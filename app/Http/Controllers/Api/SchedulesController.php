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
    public function index()
    {
        $schedules = Schedule::all(); 
        return view('schedule.index', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $courses = Course::all();
        return view('schedule.create', compact('courses'));
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
        $schedule = Schedule::findOrFail($id);
        
        // Aquí también debes mandar los cursos para que el <select> no falle al editar
        $courses = Course::all(); 
        return view('schedule.edit', compact('schedule', 'courses'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
