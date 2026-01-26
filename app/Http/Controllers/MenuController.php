<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * =========================
     * ADMIN - MENU MANAGEMENT
     * =========================
     */

       // LIST + SEARCH + PAGINATION
    public function adminIndex(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('category', 'like', '%'.$request->search.'%');
        }

        $menus = $query->paginate(10);

        $signatureMenus = Menu::where('is_signature', true)->get();
        $coffeeMenus = Menu::where('category', 'coffee')->get();

        return view('admin.menus.index', compact('menus', 'signatureMenus', 'coffeeMenus'));
    }

    public function show(Menu $menu)
{
    return view('admin.menus.show', compact('menu'));
}


    // FORM TAMBAH MENU
    public function create()
    {
        return view('admin.menus.create');
    }

    // SIMPAN MENU + IMAGE
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'price'    => 'required|numeric',
            'category' => 'required',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        Menu::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'category'     => $request->category,
            'image'        => $imagePath,
            'is_signature' => $request->has('is_signature'),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    // UPDATE MENU + IMAGE
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'     => 'required',
            'price'    => 'required|numeric',
            'category' => 'required',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            $menu->image = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'category'     => $request->category,
            'is_signature' => $request->has('is_signature'),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    // HAPUS GAMBAR SAJA
    public function deleteImage(Menu $menu)
    {
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->update(['image' => null]);

        return back()->with('success', 'Gambar menu dihapus');
    }

    // HAPUS MENU
    public function destroy(Menu $menu)
    {
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus');
    }

    // TOGGLE SIGNATURE
    public function toggleSignature(Menu $menu)
    {
        $menu->update([
            'is_signature' => !$menu->is_signature
        ]);

        return response()->json(['success' => true]);
    }

    // TOGGLE AVAILABLE
    public function toggleAvailable(Menu $menu)
    {
        $menu->update([
            'is_available' => !$menu->is_available
        ]);

        return response()->json(['success' => true]);
    }
}
