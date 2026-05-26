<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Movie;

class ScheduleController
{
    // tampil semua schedule
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedules.index', compact('schedules'));
    }

    // form tambah schedule
    public function create()
    {
        $movies = Movie::all();
        return view('schedules.create', compact('movies'));
    }

    // simpan schedule
    public function store(Request $request)
    {
        Schedule::create([
            'movie_id' => $request->movie_id,
            'studio' => $request->studio,
            'show_time' => $request->show_time,
            'price' => $request->price
        ]);

        return redirect('/schedules');
    }
    // form edit
public function edit($id)
{
    $schedule = Schedule::findOrFail($id);
    $movies = Movie::all();

    return view('schedules.edit', compact('schedule', 'movies'));
}

// update schedule
public function update(Request $request, $id)
{
    $schedule = Schedule::findOrFail($id);

    $schedule->update([
        'movie_id' => $request->movie_id,
        'studio' => $request->studio,
        'show_time' => $request->show_time,
        'price' => $request->price
    ]);

    return redirect('/schedules');
}

// delete schedule
public function destroy($id)
{
    $schedule = Schedule::findOrFail($id);
    $schedule->delete();

    return redirect('/schedules');
}
}