<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // =========================
    // PUBLIC FRONTEND
    // =========================
    public function index()
    {
        // All available menus
        $allMenus = Menu::where('is_available', true)->get();

        // Signature menu
        $signatureMenus = Menu::where('is_signature', true)
            ->where('is_available', true)
            ->get();

        // Limited menus (assuming from 'Menu Terbatas' category)
        $limitedMenus = Menu::where('is_available', true)
            ->whereHas('category', function($q){
                $q->where('name', 'Menu Terbatas');
            })->get();

        return view('coffeeshop', compact('allMenus', 'signatureMenus', 'limitedMenus'));
    }

    // =========================
    // ADMIN DASHBOARD
    // =========================

    // List menu admin
    public function adminIndex(Request $request)
    {
        $query = Menu::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $query->latest()->paginate(9);

        $signatureMenus = Menu::where('is_signature', true)->latest()->get();
        $coffeeMenus = Menu::whereHas('category', fn($q) => $q->where('name','Coffee'))
                           ->latest()->get();

        return view('admin.menus.index', compact('menus','signatureMenus','coffeeMenus'));
    }

    // Form tambah menu
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    // Simpan menu
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        // Jika checkbox tidak dicentang, set jadi 0. Jika dicentang, set jadi 1.
        $data['is_signature'] = $request->has('is_signature') ? 1 : 0;
        $data['is_available'] = $request->has('is_available') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambah!');
    }

    // Form edit menu
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));
    }

    // Update menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->hasFile('image')) {
            if($menu->image) Storage::disk('public')->delete($menu->image);
            $menu->image = $request->file('image')->store('menus','public');
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_signature' => $request->has('is_signature'),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success','Menu berhasil diupdate');
    }

    // Hapus menu
    public function destroy(Menu $menu)
    {
        if($menu->image) Storage::disk('public')->delete($menu->image);
        $menu->delete();
        return back()->with('success','Menu berhasil dihapus');
    }

    // Toggle signature
    public function toggleSignature(Menu $menu)
    {
        $menu->update(['is_signature' => !$menu->is_signature]);
        return response()->json(['success'=>true]);
    }

    // Toggle available
    public function toggleAvailable(Menu $menu)
    {
        $menu->update(['is_available' => !$menu->is_available]);
        return response()->json(['success'=>true]);
    }

    // =========================
    // API
    // =========================
    public function apiShow(Menu $menu)
    {
        return response()->json([
            'id' => $menu->id,
            'name' => $menu->name,
            'description' => $menu->description,
            'price' => $menu->price,
            'image' => $menu->image
        ]);
    }
}

