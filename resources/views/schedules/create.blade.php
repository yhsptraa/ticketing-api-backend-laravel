<h1>Tambah Schedule</h1>

<form action="/schedules" method="POST">
    @csrf

    <select name="movie_id">
        @foreach ($movies as $movie)

            <option value="{{ $movie->id }}">
                {{ $movie->title }}
            </option>

        @endforeach
    </select>

    <br><br>

    <input type="text" name="studio" placeholder="Studio">
    <br><br>

    <input type="text" name="show_time" placeholder="Jam Tayang">
    <br><br>

    <input type="number" name="price" placeholder="Harga">
    <br><br>

    <button type="submit">
        Save
    </button>
</form>