<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        return view('studios.index', compact('studios'));
    }

    public function show($id)
    {
        $studio = Studio::findOrFail($id);
        return view('studios.show', compact('studio'));
    }
}
