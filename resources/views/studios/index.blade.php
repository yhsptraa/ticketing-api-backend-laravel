@extends('layouts.app')

@section('title', 'Studios - CineTicket')

@section('content')

<h1>STUDIO LIST</h1>

@if(auth()->check() && auth()->user()->role == 'admin')
    <a href="/admin/studios/create">Tambah Studio</a><br><br>
@endif

@foreach ($studios as $studio)

    <td>
        @if($studio->image)
            <img src="{{ $studio->image }}" width="300">
        @endif
    </td>

    <h2>{{ $studio->name }}</h2>

    <p>Capacity : {{ $studio->capacity }}</p>

    <p>Description : {{ $studio->description }}</p>

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

@endforeach

@endsection