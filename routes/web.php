<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;


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