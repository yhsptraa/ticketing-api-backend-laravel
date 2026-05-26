<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController
{
    // tampil semua movie
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    // form tambah movie
    public function create()
    {
        return view('movies.create');
    }

    // simpan movie
    public function store(Request $request)
    {
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
            'duration' => $request->duration,
            'poster' => $request->poster
        ]);

        return redirect('/movies');
    }

    // detail movie
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    // form edit
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    // update movie
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->update([
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
            'duration' => $request->duration,
            'poster' => $request->poster
        ]);

        return redirect('/movies');
    }

    // delete movie
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('/movies');
    }
}