@extends('layouts.app')

@section('title', 'Seats - CineTicket')

@section('content')

@if(session('success'))
    {{ session('success') }}
@endif

<h1>SEAT LIST</h1>

@auth
    @if(auth()->check() && auth()->user()->role == 'admin')
        <a href="/admin/seats/create">Tambah Seat</a>
    @endif
@endauth
<br>
<a href="/studios">Kembali ke Studio</a>
<br><br>

@foreach ($seats as $seat)

    <h2>{{ $seat->studio->studio_name ?? 'Studio Tidak Ada' }}</h2>

    <p>Seat Number : {{ $seat->seat_number }}</p>
    <p>Status : {{ $seat->is_available ? 'Available' : 'Occupied' }}</p>

    <a href="/seats/{{ $seat->id }}">Detail</a>

    @auth
        @if(auth()->check() && auth()->user()->role == 'admin')

            <a href="{{ route('admin.seats.edit', $seat->id) }}">
                Edit
            </a>

            <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>

        @endif
    @endauth

    <hr>

@endforeach

@endsection