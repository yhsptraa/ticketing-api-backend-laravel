@extends('layouts.app')

@section('content')

<h1>My Watchlist</h1>

<hr>

<div style="display:flex; flex-wrap:wrap; gap:30px;">

    @forelse ($watchlists as $watchlist)

        <div style="width:220px;">

            <img src="{{ $watchlist->movie->poster }}" width="200">

            <h2>{{ $watchlist->movie->title }}</h2>

            <form action="{{ route('watchlist.destroy', $watchlist->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">
                    🖤 Remove from Watchlist
                </button>
            </form>

        </div>

    @empty

        <p>No movies in your watchlist.</p>

    @endforelse

</div>

@endsection