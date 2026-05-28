<h1>{{ $movie->title }}</h1>

<img src="{{ $movie->poster }}" width="200">

<p>{{ $movie->description }}</p>

<p>Genre: {{ $movie->genre }}</p>

<p>Duration: {{ $movie->duration }} menit</p>

<hr>

<h2>Schedule</h2>

@foreach ($movie->schedules as $schedule)

    <p>Studio : {{ $schedule->studio }}</p>

    <p>Jam : {{ $schedule->show_time }}</p>

    <p>Harga : Rp {{ $schedule->price }}</p>

    @if(auth()->check())

        <button>
            Buy Ticket
        </button>

    @else

        <a href="/login">
            <button>
                Buy Ticket
            </button>
        </a>

    @endif

    <hr>

@endforeach