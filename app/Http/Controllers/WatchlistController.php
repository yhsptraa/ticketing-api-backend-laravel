<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function store(Movie $movie)
    {
        Watchlist::firstOrCreate([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
        ]);

        return redirect()->back()->with('watchlist_success', 'Added to watchlist.');
    }

    public function destroy(Watchlist $watchlist)
    {
        if ($watchlist->user_id !== Auth::id()) {
            abort(403);
        }

        $watchlist->delete();

        return redirect()->back()->with('success', 'Removed from watchlist.');
    }

    public function index()
    {
        $watchlists = Auth::user()
            ->watchlists()
            ->with('movie')
            ->latest()
            ->get();

        return view('user.watchlists', compact('watchlists'));
    }
}