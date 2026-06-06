@extends('layouts.app')

@section('title', 'Create Seat - CineTicket')

@section('content')

<h1>Detail Seat</h1>

<h2>{{ $seat->studio->studio_name ?? 'Studio Tidak Ada' }}</h2>

<p>Seat Number : {{ $seat->seat_number }}</p>
<p>Status : {{ $seat->is_available ? 'Available' : 'Occupied' }}</p>

<a href="/seats">Kembali</a>

@endsection