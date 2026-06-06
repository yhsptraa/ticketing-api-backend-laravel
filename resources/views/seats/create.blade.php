@extends('layouts.app')

@section('title', 'Add Seat - CineTicket')

@section('content')

<h1>Add Seat</h1>

<form action="/admin/seats" method="POST">
    @csrf
    <label>Studio</label><br>
    <select name="studio_id">
        @foreach ($studios as $studio)
            <option value="{{ $studio->id }}">{{ $studio->studio_name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Number of Rows</label><br>
    <input type="number" name="rows" min="1" required>
    <br><br>

    <label>Seats Per Row</label><br>
    <input type="number" name="columns" min="1" required>
    <br><br>

    <label>Status</label><br>
    <select name="is_available">
        <option value="1">Available</option>
        <option value="0">Occupied</option>
    </select>
    <br><br>

    <button type="submit">Add</button>
</form>

@endsection