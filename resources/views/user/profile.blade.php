@extends('layouts.app')

@section('title', 'Profile - CineTicket')

@section('content')
    <h1>Profile</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>

    <br>
    <a href="{{ route('user.profile.edit') }}">Edit Profile</a>
@endsection
