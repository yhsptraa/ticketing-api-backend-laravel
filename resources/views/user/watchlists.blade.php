@extends('layouts.app')

@section('content')
<h1>My Watchlist</h1>

@forelse ($watchlists as $watchlist)

    <div>
        <h3>{{ $watchlist->movie->title }}</h3>

        <form action="{{ route('watchlist.destroy', $watchlist->id) }}"
              method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">
                Remove
            </button>
        </form>
    </div>

    <hr>

@empty

    <p>No movies in your watchlist.</p>

@endforelse
@endsection