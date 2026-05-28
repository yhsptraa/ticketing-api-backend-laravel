<h1>SCHEDULE LIST</h1>

<a href="/admin/schedules/create">Tambah Schedule</a>

<hr>

@foreach ($schedules as $schedule)

    <h2>{{ $schedule->movie->title ?? 'Movie Tidak Ada' }}</h2>

    <p>Studio : {{ $schedule->studio }}</p>

    <p>Jam : {{ $schedule->show_time }}</p>

    <p>Harga : Rp {{ $schedule->price }}</p>

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

    <hr>

@endforeach