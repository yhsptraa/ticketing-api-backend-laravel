@extends('layouts.app')

@section('title', 'Add Studio - CineTicket')

@section('content')

<h1>Add Studio</h1>

<form action="/admin/studios" method="POST">
    @csrf
    <label>Image URL</label><br>
    <input type="text" name="studio_image">
    <br><br>

    <label>Studio Name</label><br>
    <input type="text" name="studio_name" required>
    <br><br>

    <label>Capacity</label><br>
    <input type="number" name="capacity" required>
    <br><br>

    <label>Description</label><br>
    <input textarea name="description"></textarea>
    <br><br>

    <label>Status</label><br>
    <select name="is_active">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
    <br><br>

    <button type="submit">Save</button>
    
</form>

@endsection