<h1>Edit Schedule</h1>

<form action="/admin/schedules/{{ $schedule->id }}" method="POST">
    @csrf
    @method('PUT')

    <select name="movie_id">
        @foreach ($movies as $movie)

            <option value="{{ $movie->id }}"
                {{ $movie->id == $schedule->movie_id ? 'selected' : '' }}>

                {{ $movie->title }}

            </option>

        @endforeach
    </select>

    <br><br>

    <input type="text" name="studio" value="{{ $schedule->studio }}">
    <br><br>

    <input type="text" name="show_time" value="{{ $schedule->show_time }}">
    <br><br>

    <input type="number" name="price" value="{{ $schedule->price }}">
    <br><br>

    <button type="submit">
        Update
    </button>
</form>