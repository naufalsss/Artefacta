<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Models\Artifact;
use App\Models\User;
use App\Models\Gallery;

// =====================
// PUBLIC ROUTES
// =====================
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/', function () {
    return view('coffeeshop');
})->name('coffeeshop');

// Public Gallery Page
Route::get('/koleksi-galeri', [GalleryController::class, 'published'])->name('galleries.published');

// =====================
// AUTHENTICATION ROUTES
// =====================
Route::get('/login', function () {
    return view('login');
})->name('login');

// Debug routes
Route::get('/debug-csrf', function () {
    return [
        'csrf_token' => csrf_token(),
        'session_id' => session()->getId(),
    ];
});

Route::post('/debug-login', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'status' => 'ok',
        'received' => $request->all(),
        'has_token' => $request->has('_token'),
    ]);
});

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'daftar'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// MENU ROUTES
// =====================

// PUBLIC
Route::get('/coffeeshop', [MenuController::class, 'index']);

// ADMIN
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // CRUD
    Route::get('/menus', [MenuController::class, 'adminIndex'])->name('menus.index');
    Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

    // Toggle actions
    Route::patch('menus/{menu}/toggle-signature', [MenuController::class, 'toggleSignature']);
    Route::patch('menus/{menu}/toggle-available', [MenuController::class, 'toggleAvailable']);
    });

    // Additional actions
    Route::patch('menus/{menu}/toggle-signature', [MenuController::class, 'toggleSignature']);
    Route::patch('menus/{menu}/toggle-available', [MenuController::class, 'toggleAvailable']);
    Route::delete('menus/{menu}/delete-image', [MenuController::class, 'deleteImage']);

    // Other resources
    Route::resource('users', UserController::class);

// =====================
// DASHBOARD & PROTECTED ROUTES
// =====================

Route::get('/dashboard', function () {
    $artifactsCount = Artifact::count();
    $usersCount = User::count();
    $galleriesCount = Gallery::count();
    return view('dashboard', compact('artifactsCount','usersCount','galleriesCount'));
})->name('dashboard')->middleware('admin');

// =====================
// ARTIFACT ROUTES (Resource) - Admin Only
// =====================
Route::middleware('admin')->resource('artifacts', ArtifactController::class);

// =====================
// USER ROUTES (Resource) - Admin Only
// =====================
Route::middleware('admin')->resource('users', UserController::class);

// =====================
// GALLERY ROUTES (Resource) - Admin Only
// =====================
Route::middleware('admin')->resource('galleries', GalleryController::class, [
    'only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']
]);

// =====================
// MENU ROUTES (Resource) - Admin Only
// =====================
Route::middleware('admin')->resource('menus', MenuController::class, [
    'only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']
]);
