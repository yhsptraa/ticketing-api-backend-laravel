@extends('layouts.app')

@section('title', 'Detail Studio - CineTicket')

@section('content')

<h1>Detail Studio</h1>

@auth
    @if(auth()->check() && auth()->user()->role == 'admin')
        <a href="/admin/seats?studio_id={{ $studio->id }}">Seat List</a>
    @endif
@endauth

<a href="/studios">Kembali</a><br>

@if($studio->studio_image)
    <img src="{{ $studio->studio_image }}" width="200" alt="{{ $studio->studio_name }}">
@endif

<h2>{{ $studio->studio_name }}</h2>

<p><strong>Capacity : </strong>{{ $studio->capacity }}</p>

<p><strong>Description : </strong>{{ $studio->description }}</p>

<p><strong>Status:</strong> {{ $studio->is_active ? 'Active' : 'Inactive' }}</p>

<hr>
<h3>Screen</h3>
<hr>

@foreach ($studio->seats->groupBy(fn($seat) => substr($seat->seat_number, 0, 1)) as $row => $seats)
    <div style="margin-bottom:10px;">
        @foreach ($seats as $seat)
            <a href="{{route('seats.show', $seat->id)}}">
                {{ $seat->seat_number }}
            </a>
        @endforeach
    </div>
@endforeach

@endsection