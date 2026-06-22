@extends('layouts.app')

@section('title', $movie->title . ' - CineTicket')

@section('content')

<h1>{{ $movie->title }}</h1>

<img src="{{ $movie->poster }}" width="200">

<p>{{ $movie->description }}</p>

<p>Genre: {{ $movie->genre }}</p>

<p>Duration: {{ $movie->duration }} minutes</p>

@if (session('watchlist_success'))
    <p style="color: green;">{{ session('watchlist_success') }}</p>
@endif

@auth
<form action="{{ route('watchlist.store', $movie->id) }}" method="POST">
    @csrf
    <button type="submit">
        ❤️ Add to Watchlist
    </button>
</form>
@endauth

<hr>

<h2>Schedule</h2>

@foreach ($movie->schedules as $schedule)

   <p>Studio : {{ $schedule->studio->studio_name }}</p>

    <p>Time : {{ $schedule->show_time }}</p>

    <p>Price : Rp {{ $schedule->price }}</p>

    @if(auth()->check() && auth()->user()->role == 'admin')

        <a href="{{ route('admin.schedules.edit', $schedule->id) }}">
            Edit Schedule
        </a>

        |

        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit">
                Delete Schedule
            </button>
        </form>

        <br><br>

    @endif

    @if(auth()->check())

    <a href="{{ route('bookings.showtimes', $movie->id) }}">
        <button>
            Buy Ticket
        </button>
    </a>

    @else

        <a href="/login">
            <button>
                Buy Ticket
            </button>
        </a>

    @endif

    <hr>

@endforeach

<h2>Reviews ({{ $movie->reviews->count() }})</h2>

@if (session('review_success'))
    <p style="color: green;">{{ session('review_success') }}</p>
@endif

@forelse ($movie->reviews as $review)
    <p><strong>{{ $review->user->name }}</strong> — Rating: {{ $review->rating }}/5</p>
    <p>{{ $review->comment }}</p>
    @if(auth()->check() && auth()->user()->id == $review->user_id)
        <a href="{{ route('reviews.edit', $review->id) }}">
            Edit Review
        </a>
        |
        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">
                Delete Review
            </button>
        </form>
    @endif
    <hr>
@empty
    <p>No reviews yet.</p>
    <hr>
@endforelse

@auth
    @if(!$movie->reviews->where('user_id', auth()->id())->count())
        <h3>Write a Review</h3>
        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('reviews.store', $movie->id) }}">
            @csrf
            <div>
                <input type="radio" name="rating" value="1" required> ⭐
            </div>
            <div>
                <input type="radio" name="rating" value="2"> ⭐⭐
            </div>
            <div>
                <input type="radio" name="rating" value="3"> ⭐⭐⭐
            </div>
            <div>
                <input type="radio" name="rating" value="4"> ⭐⭐⭐⭐
            </div>
            <div>
                <input type="radio" name="rating" value="5"> ⭐⭐⭐⭐⭐
            </div>
            <br>
            <div>
                <label>Comment</label><br>
                <textarea name="comment" rows="4" required>{{ old('comment') }}</textarea>
            </div>
            <br>
            <button type="submit">
                Submit Review
            </button>
        </form>
    @else
        <p>You have already reviewed this movie.</p>
    @endif
@endauth

@endsection
