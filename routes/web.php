<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman view
Route::get('/', fn () => view('login'))->name('login.form');
Route::get('/welcome', fn () => view('welcome'))->middleware('auth')->name('welcome');
Route::get('/dashboard', function () {
    return redirect()->route('artifacts.index');
})->middleware(['auth', 'admin']);


// routes untuk form
Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Routes untuk CRUD Artifacts
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('artifacts', ArtifactController::class);
    Route::resource('users', UserController::class);
});

