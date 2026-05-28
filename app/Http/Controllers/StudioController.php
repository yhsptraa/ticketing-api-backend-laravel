<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
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
            'is_active' => $request->is_active
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
