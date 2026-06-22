@extends('layouts.app')

@section('title', 'Studios - CineTicket')

@section('content')

@if(session('success'))
    {{ session('success') }}
@endif

<h1>STUDIO LIST</h1>

@if(auth()->check() && auth()->user()->role == 'admin')
    <a href="/admin/studios/create">Tambah Studio</a><br>
    <a href="{{ route('seats.index') }}">Seat List</a><br>
@endif
<a href="/">Kembali</a>
<br><br>

<div style="display:flex; flex-wrap:wrap; gap:30px;">

    @foreach ($studios as $studio)

        <div style="width:300px;">

            @if($studio->image)
                <img src="{{ $studio->image }}" style="width:300px; height:200px;" >
            @endif

        <h2>{{ $studio->studio_name }}</h2>

        <p>Capacity : {{ $studio->capacity }}</p>

        <p>Description : {{ $studio->description }}</p>

        <a href="/studios/{{ $studio->id }}">Detail</a>

        @if(auth()->check() && auth()->user()->role == 'admin')

            <a href="{{ route('admin.studios.edit', $studio->id) }}">
                Edit
            </a>

            <form method="POST" action="{{ route('admin.studios.destroy', $studio->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>

        @endif

        <hr>
</div>
@endforeach
</div>
@endsection