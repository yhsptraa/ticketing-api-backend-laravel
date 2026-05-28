<h1>Edit Movie</h1>

<form action="/admin/movies/{{ $movie->id }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $movie->title }}">
    <br><br>

    <input type="text" name="genre" value="{{ $movie->genre }}">
    <br><br>

    <input type="number" name="duration" value="{{ $movie->duration }}">
    <br><br>

    <textarea name="description">{{ $movie->description }}</textarea>
    <br><br>

    <input type="text" name="poster" value="{{ $movie->poster }}">
    <br><br>

    <button type="submit">Update</button>
</form>