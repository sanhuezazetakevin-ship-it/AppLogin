<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;   // Importamos tus modelos para mostrar estadísticas
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Protege este controlador: solo usuarios logueados pueden entrar
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // 1. Obtener el usuario autenticado
        $user = Auth::user();

        // 2. Recuperar el dispositivo que guardamos en la sesión durante el Login/Register
        $device = $request->session()->get('device', 'Desconocido');

        // 3. Generar estadísticas rápidas para el Dashboard (opcional pero recomendado)
        // Usamos un try-catch por si aún no tienes creadas todas las tablas o modelos en tu DB
        try {
            $totalStudents = Student::count();
            $totalCourses  = Course::count();
            $totalTeachers = Teacher::count();
        } catch (\Exception $e) {
            // Si las tablas no existen todavía, ponemos valores en 0 por seguridad
            $totalStudents = 0;
            $totalCourses  = 0;
            $totalTeachers = 0;
        }

        // 4. Pasar todas las variables ordenadas a la vista 'home'
        return view('home', compact(
            'user', 
            'device', 
            'totalStudents', 
            'totalCourses', 
            'totalTeachers'
        ));
    }
}