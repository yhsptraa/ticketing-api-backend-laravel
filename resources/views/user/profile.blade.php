@extends('layouts.app')

@section('title', 'Profile - CineTicket')

@section('content')
    <h1>Profile</h1>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
@endsection
