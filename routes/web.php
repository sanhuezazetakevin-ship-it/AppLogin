<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class,'redirectToGoogle']);
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class,'handleGoogleCallback']);
Route::middleware(['auth'])->get('/dashboard', function(){
    return view('dashboard');
});
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {
    
    // Al usar Route::resource, Laravel mapea el HTML directamente con tu controlador
    Route::resource('students', StudentsController::class);
    Route::resource('teachers', TeachersController::class);
    Route::resource('courses', CoursesController::class);
    Route::resource('schedules', SchedulesController::class);
});


Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/login/github', [
    LoginController::class,
    'redirectToGithub'
]);

Route::get('/login/github/callback', [
    LoginController::class,
    'handleGithubCallback'
]);
