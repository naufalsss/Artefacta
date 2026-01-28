<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Wajib diimport
use App\Models\Menu;
use App\Models\Booking;
use App\Models\Artifact;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Fungsi harus di dalam Class
    public function index()
    {
        return view('dashboard', [
            'artifactsCount' => Artifact::count(),
            'usersCount' => User::count(),
            'galleriesCount' => Gallery::count(),
            'menusCount' => Menu::count(),
            'availableMenus' => Menu::where('is_available', true)->count(),
            'signatureMenus' => Menu::where('is_signature', true)->count(),
            'bookingsCount' => Booking::count(),
            'todayBookings' => Booking::whereDate('visit_date', today())->count(),
            'totalTickets' => Booking::sum(\DB::raw('JSON_LENGTH(tickets)')),
        ]);
    }
}
