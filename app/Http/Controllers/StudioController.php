<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class StudioController
{
    public function index()
    {
        $studios = Studio::all();
        return view('studios.index', compact('studios'));
    }

    public function store(Request $request)
    {
        Studio::create([
            'studio_name' => $request->studio_name, 
            'capacity' => $request->capacity,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'image' => $request->studio_image,
        ]);
        return redirect('/admin/studios');
    }

    public function show($id)
    {
        $studio = Studio::findOrFail($id);
        return view('studios.show', compact('studio'));
    }

    public function create()
    {
        return view('studios.create');
    }

    public function edit($id)
    {
        $studio = Studio::findOrFail($id);
        return view('studios.edit', compact('studio'));
    }

    public function update(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);
        $studio->update($request->all());
        return redirect('/admin/studios');
    }

    public function destroy(string $id)
    {
        $studio = Studio::findOrFail($id);
        $studio->delete();
        return redirect('/admin/studios');
    }
}
