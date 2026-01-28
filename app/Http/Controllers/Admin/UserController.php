<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Ambil kategori yang punya menu tersedia
        $categories = Category::with(['menus' => function ($query) {
            $query->where('is_available', true);
        }])->get();

        // Signature menu
        $signatureMenus = Menu::where('is_signature', true)
            ->where('is_available', true)
            ->get();

        // Coffee menu (berdasarkan relasi category)
        $coffeeMenus = Menu::where('is_available', true)
            ->whereHas('category', function ($q) {
                $q->where('name', 'Coffee');
            })
            ->get();

        return view('coffeeshop', compact(
            'categories',
            'signatureMenus',
            'coffeeMenus'
        ));
    }
}
