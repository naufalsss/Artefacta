<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// =====================
// PUBLIC ROUTES
// =====================
Route::get('/', function () {
    return view('home');
})->name('home');

// =====================
// AUTHENTICATION ROUTES
// =====================
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'daftar'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// DASHBOARD & PROTECTED ROUTES
// =====================
Route::get('/dashboard', function () {
    return redirect()->route('artifacts.index');
})->name('dashboard')->middleware('admin');

// =====================
// ARTIFACT ROUTES (Resource) - Admin Only
// =====================
Route::middleware('admin')->resource('artifacts', ArtifactController::class);

// =====================
// USER ROUTES (Resource) - Admin Only
// =====================
Route::middleware('admin')->resource('users', UserController::class);
