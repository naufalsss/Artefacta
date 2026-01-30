<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CoffeeshopController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/coffeeshop', [MenuController::class, 'index'])
    ->name('coffeeshop');

Route::get('/booking', [BookingController::class, 'bookingIndex'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/pemesanan', [BookingController::class, 'index'])->name('booking');

Route::get('/galeri', [GalleryController::class, 'published'])->name('galleries.published');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proses Registrasi
Route::post('/register', [AuthController::class, 'daftar'])->name('register.submit');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('artifacts', ArtifactController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('bookings', BookingController::class)->except(['create', 'store']);
        #'index' => 'admin.bookings.index',
        #'show' => 'admin.bookings.show',
        #'edit' => 'admin.bookings.edit',
        #'update' => 'admin.bookings.update',
        #'destroy' => 'admin.bookings.destroy',
});

// User routes
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->except(['index', 'create', 'store']);
    Route::resource('artifacts', ArtifactController::class)->except(['index']);
    Route::resource('galleries', GalleryController::class)->except(['index']);
});
