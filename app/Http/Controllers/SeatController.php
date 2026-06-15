<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Studio;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index(Request $request)
    {
        if($request->studio_id){
            $seats = Seat::where('studio_id', $request->studio_id)->with('studio')->get();
        }else{
            $seats = Seat::with('studio')->get();
        }
        return view('seats.index', compact('seats'));
    }

    public function create()
    {
        $studios = Studio::all();
        return view('seats.create', compact('studios'));
    }

    public function store(Request $request){
        for ($i = 0; $i < $request->rows; $i++) {
            $rowLetter = chr(65 + $i);
            for ($j = 1; $j <= $request->columns; $j++) {
                Seat::create([
                    'studio_id' => $request->studio_id,
                    'seat_number' => $rowLetter . $j,
                    'is_available' => true,
                ]);
            }
        }
    return redirect('/admin/seats?studio_id='. $request->studio_id)->with('success', 'Seat updated successfully');
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
        return redirect('/admin/seats?studio_id='. $seat->studio_id)->with('success', 'Seat updated successfully');
    }

    public function destroy(string $id)
    {
        $seat = Seat::findOrFail($id);
        $seat->delete();
        return redirect('/admin/seats?studio_id='. $seat->studio_id)->with('success', 'Seat deleted successfully');
    }

    public function show($id)
    {
        $seat = Seat::with('studio')->findOrFail($id);
        return view('seats.show', compact('seat'));
    }
}