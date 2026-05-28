@extends('layouts.app')

@section('title', 'Schedules - CineTicket')

@section('content')

<h1>SCHEDULE LIST</h1>

@if(auth()->check() && auth()->user()->role == 'admin')
    <a href="/admin/schedules/create">Tambah Schedule</a>
@endif

<hr>

@foreach ($schedules as $schedule)

    <h2>{{ $schedule->movie->title ?? 'Movie Tidak Ada' }}</h2>

    <p>Studio : {{ $schedule->studio }}</p>

    <p>Jam : {{ $schedule->show_time }}</p>

    <p>Harga : Rp {{ $schedule->price }}</p>

    @if(auth()->check() && auth()->user()->role == 'admin')

        <a href="{{ route('admin.schedules.edit', $schedule->id) }}">
            Edit
        </a>

        |

        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit">
                Delete
            </button>
        </form>

    @endif

    <hr>

@endforeach

@endsection
