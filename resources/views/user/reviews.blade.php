@extends('layouts.app')

@section('title', 'My Reviews - CineTicket')

@section('content')

<h1>My Reviews</h1>

@if ($reviews->isEmpty())
    <p>Kamu belum menulis review apapun.</p>
@else
    @foreach ($reviews as $review)
        <h3>{{ $review->movie->title }}</h3>
        <p>Rating: {{ $review->rating }}/5</p>
        <p>{{ $review->comment }}</p>
        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus Review</button>
        </form>
        <hr>
    @endforeach
@endif

@endsection
