<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Studio;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::with('studio')->get();
        return view('seats.index', compact('seats'));
    }

    public function create()
    {
        $studios = Studio::all();
        return view('seats.create', compact('studios'));
    }

    public function store(Request $request)
    {
        Seat::create($request->all());
        return redirect('/admin/seats');
    }

    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $studios = Studio::all();
        return view('seats.edit', compact('seat', 'studios'));
    }

    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);
        $seat->update($request->all());
        return redirect('/admin/seats');
    }

    public function destroy(string $id)
    {
        $seat = Seat::findOrFail($id);
        return redirect('/admin/seats');
    }

    public function show($id)
    {
        $seat = Seat::with('studio')->findOrFail($id);
        return view('seats.show', compact('seat'));
    }
}