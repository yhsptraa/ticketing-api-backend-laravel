@extends('layouts.app')

@section('title', 'Detail Studio - CineTicket')

@section('content')

<h1>Detail Studio</h1>

<h2>{{ $studio->studio_name }}</h2>

<p><strong>Capacity : </strong>{{ $studio->capacity }}</p>

<p><strong>Description : </strong>{{ $studio->description }}</p>

<p><strong>Status:</strong> {{ $studio->is_active ? 'Active' : 'Inactive' }}</p>

<a href="/studios">Kembali</a>

@endsection