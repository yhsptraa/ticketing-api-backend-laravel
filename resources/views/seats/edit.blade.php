@extends('layouts.app')

@section('title', 'Edit Seat - CineTicket')

@section('content')

<h1>Edit Seat</h1>

<form action="/admin/seats/{{ $seat->id }}" method="POST">
    @csrf
    @method('PUT')
    <label>Studio</label><br>
    <select name="studio_id">
        @foreach ($studios as $studio)
            <option value="{{ $studio->id }}">{{ $studio->studio_name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Seat Number</label><br>
    <input type="text" name="seat_number" value="{{ $seat->seat_number }}">
    <br><br>

    <label>Status</label><br>
    <select name="is_available">
        <option value="1" {{ $seat->is_available ? 'selected' : '' }}>Available</option>
        <option value="0" {{ !$seat->is_available ? 'selected' : '' }}>Occupied</option>
    </select>
    <br><br>

    <button type="submit">Edit</button>
</form>

@endsection