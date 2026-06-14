@extends('layouts.app')

@section('title', 'My Reviews - CineTicket')

@section('content')

<h1>My Reviews</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($reviews->isEmpty())
    <p>No reviews yet.</p>
@else
    @foreach ($reviews as $review)
        <h3>{{ $review->movie->title }}</h3>
        <p>
            {{ str_repeat('⭐', $review->rating) }}
            ({{ $review->rating }}/5)
        </p>
        <p>{{ $review->comment }}</p>

        <a href="{{ route('reviews.edit', $review->id) }}">Edit Review</a>
        &nbsp;|&nbsp;
        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Review</button>
        </form>

        <hr>
    @endforeach

    {{ $reviews->links() }}
@endif

@endsection
