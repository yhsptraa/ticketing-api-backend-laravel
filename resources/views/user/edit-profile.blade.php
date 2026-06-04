@extends('layouts.app')

@section('title', 'Edit Profile - CineTicket')

@section('content')

<h1>Edit Profile</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('user.profile.update') }}">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <br>

    <div>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <br>

    <h3>Change Password (optional)</h3>

    <div>
        <label for="current_password">Current Password</label><br>
        <input type="password" id="current_password" name="current_password">
    </div>

    <br>

    <div>
        <label for="password">New Password</label><br>
        <input type="password" id="password" name="password">
    </div>

    <br>

    <div>
        <label for="password_confirmation">Confirm New Password</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>

    <br>

    <button type="submit">Save Changes</button>
    &nbsp;
    <a href="{{ route('user.profile') }}">Cancel</a>
</form>

@endsection
