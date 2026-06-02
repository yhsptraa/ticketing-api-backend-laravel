@extends('layouts.app')

@section('title', 'Edit Studio - CineTicket')

@section('content')

<h1>Edit Studio</h1>

<form action="/admin/studios/{{ $studio->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Studio Name</label><br>
    <input type="text" name="studio_name" value="{{ $studio->studio_name }}" required>
    <br><br>

    <label>Capacity</label><br>
    <input type="number" name="capacity" value="{{ $studio->capacity }}" required>
    <br><br>

    <label>Description</label><br>
    <input textarea name="description" value="{{ $studio->description }}"></textarea>
    <br><br>

    <label>Status</label><br>
    <select name="is_active">
        <option value="1" {{ $studio->is_active == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $studio->is_active == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
    <br><br>

    <button type="submit">
        Save
    </button>
    
</form>

@endsection