<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Artifact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource (Admin - Dashboard only)
     */
    public function index()
    {
        $galleries = Gallery::with('artifact')->latest()->paginate(12);
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Display published galleries for public viewing
     */
    public function published()
    {
        $galleries = Gallery::where('is_published', true)->latest()->paginate(12);
        return view('galleries.published', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $artifacts = Artifact::all();
        return view('galleries.create', compact('artifacts'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'artifact_id' => 'nullable|exists:artifacts,id',
        ];

        // Only add crop validation if crop fields exist in database
        if (\Schema::hasColumn('galleries', 'crop_x')) {
            $rules['crop_x'] = 'nullable|integer|min:0';
            $rules['crop_y'] = 'nullable|integer|min:0';
            $rules['crop_width'] = 'nullable|integer|min:0';
            $rules['crop_height'] = 'nullable|integer|min:0';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('galleries', 'public');
        }

        // Handle checkbox - will be 1 if checked, 0 otherwise
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        // Ensure crop fields are only saved if they exist in the model
        if (!\Schema::hasColumn('galleries', 'crop_x')) {
            unset($data['crop_x'], $data['crop_y'], $data['crop_width'], $data['crop_height']);
        }

        Gallery::create($data);

        return Redirect::route('galleries.index')->with('success', 'Gallery item created successfully.');
    }

    /**
     * Display the specified resource
     */
    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Gallery $gallery)
    {
        $artifacts = Artifact::all();
        return view('galleries.edit', compact('gallery', 'artifacts'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Gallery $gallery)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'artifact_id' => 'nullable|exists:artifacts,id',
        ];

        // Only add crop validation if crop fields exist in database
        if (\Schema::hasColumn('galleries', 'crop_x')) {
            $rules['crop_x'] = 'nullable|integer|min:0';
            $rules['crop_y'] = 'nullable|integer|min:0';
            $rules['crop_width'] = 'nullable|integer|min:0';
            $rules['crop_height'] = 'nullable|integer|min:0';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            // delete old file
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('galleries', 'public');
        }

        // Handle checkbox - will be 1 if checked, 0 otherwise
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        // Ensure crop fields are only saved if they exist in the model
        if (!\Schema::hasColumn('galleries', 'crop_x')) {
            unset($data['crop_x'], $data['crop_y'], $data['crop_width'], $data['crop_height']);
        }

        $gallery->update($data);

        return Redirect::route('galleries.index')->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();
        return Redirect::route('galleries.index')->with('success', 'Gallery item deleted successfully.');
    }
}
