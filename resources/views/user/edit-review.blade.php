@extends('layouts.app')

@section('title', 'Edit Review - CineTicket')

@section('content')

<h1>Edit Review - {{ $review->movie->title }}</h1>

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('reviews.update', $review->id) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Rating</label><br>
        @for ($i = 1; $i <= 5; $i++)
            <label>
                <input type="radio" name="rating" value="{{ $i }}" {{ $review->rating == $i ? 'checked' : '' }} required>
                {{ str_repeat('⭐', $i) }}
            </label>
        @endfor
    </div>

    <br>

    <div>
        <label>Comment</label><br>
        <textarea name="comment" rows="4" required>{{ old('comment', $review->comment) }}</textarea>
    </div>

    <br>

    <button type="submit">Save</button>
    &nbsp;
    <a href="{{ route('user.reviews') }}">Cancel</a>
</form>

@endsection
