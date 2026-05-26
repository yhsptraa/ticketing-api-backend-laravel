<h1>Tambah Movie</h1>

<form action="/movies" method="POST">
    @csrf

    <input type="text" name="title" placeholder="Title">
    <br><br>

    <input type="text" name="genre" placeholder="Genre">
    <br><br>

    <input type="number" name="duration" placeholder="Duration">
    <br><br>

    <textarea name="description" placeholder="Description"></textarea>
    <br><br>

    <input type="text" name="poster" placeholder="Poster URL">
    <br><br>

    <button type="submit">Save</button>
</form>