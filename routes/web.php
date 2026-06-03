<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\TeachersController;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\SchedulesController;
use App\Http\Controllers\Api\EnrollmentsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* ================= GOOGLE LOGIN ================= */
Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

/* ================= DASHBOARD ================= */
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('home');
}); 

/* ================= CRUD ================= */
Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentsController::class);
    Route::resource('teachers', TeachersController::class);
    Route::resource('courses', CoursesController::class);
    Route::resource('schedules', SchedulesController::class);
    Route::resource('enrollments', EnrollmentsController::class);
});

/* ================= GITHUB LOGIN ================= */
Route::get('/login/github', [LoginController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/login/github/callback', [LoginController::class, 'handleGithubCallback'])->name('auth.github.callback');
