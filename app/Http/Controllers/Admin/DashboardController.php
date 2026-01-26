<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Wajib diimport
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Fungsi harus di dalam Class
    public function index()
    {
        return view('dashboard', [
            'menusCount' => Menu::count(),
            'availableMenus' => Menu::where('is_available', true)->count(),
            'signatureMenus' => Menu::where('is_signature', true)->count(),
        ]);
    }
}
