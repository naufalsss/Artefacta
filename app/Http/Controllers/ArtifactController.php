<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artifacts = Artifact::all();
        return view('artifacts.index', compact('artifacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artifacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Artifact::create($request->all());

        return redirect()->route('artifacts.index')->with('success', 'Artifact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artifact $artifact)
    {
        return view('artifacts.show', compact('artifact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artifact $artifact)
    {
        return view('artifacts.edit', compact('artifact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artifact $artifact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $artifact->update($request->all());

        return redirect()->route('artifacts.index')->with('success', 'Artifact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artifact $artifact)
    {
        $artifact->delete();

        return redirect()->route('artifacts.index')->with('success', 'Artifact deleted successfully.');
    }
}
