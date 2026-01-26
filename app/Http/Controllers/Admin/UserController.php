<?php
namespace App\Http\Controllers;

use App\Models\Menu;

class UserController extends Controller
{
    public function shop()
    {
        return view('coffeeshop', [
            'menus' => Menu::where('is_available', true)->get(),
            'signatureMenus' => Menu::where('is_signature', true)
                                    ->where('is_available', true)
                                    ->get(),
            'coffeeMenus' => Menu::where('category', 'Coffee')
                                 ->where('is_available', true)
                                 ->get(),
        ]);
    }
}

