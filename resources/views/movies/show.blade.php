@extends('layouts.app')

@section('title', $movie->title . ' - CineTicket')

@section('content')

<h1>{{ $movie->title }}</h1>

<img src="{{ $movie->poster }}" width="200">

<p>{{ $movie->description }}</p>

<p>Genre: {{ $movie->genre }}</p>

<p>Duration: {{ $movie->duration }} minutes</p>

<hr>

<h2>Schedule</h2>

@foreach ($movie->schedules as $schedule)

    <p>Studio : {{ $schedule->studio }}</p>

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

        <button>
            Buy Ticket
        </button>

    @else

        <a href="/login">
            <button>
                Buy Ticket
            </button>
        </a>

    @endif

    <hr>

@endforeach

<h2>Reviews</h2>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@forelse ($movie->reviews as $review)
    <p><strong>{{ $review->user->name }}</strong> — Rating: {{ $review->rating }}/5</p>
    <p>{{ $review->comment }}</p>
    @if(auth()->check() && auth()->user()->id == $review->user_id)
        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Review</button>
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
                <label>Rating</label><br>
                <label><input type="radio" name="rating" value="1" required> ⭐</label>
                <label><input type="radio" name="rating" value="2"> ⭐⭐</label>
                <label><input type="radio" name="rating" value="3"> ⭐⭐⭐</label>
                <label><input type="radio" name="rating" value="4"> ⭐⭐⭐⭐</label>
                <label><input type="radio" name="rating" value="5"> ⭐⭐⭐⭐⭐</label>
            </div>
            <br>
            <div>
                <label>Comment</label><br>
                <textarea name="comment" rows="4" required>{{ old('comment') }}</textarea>
            </div>
            <br>
            <button type="submit">Submit Review</button>
        </form>
    @else
        <p>You have already reviewed this movie.</p>
    @endif
@endauth

@endsection
