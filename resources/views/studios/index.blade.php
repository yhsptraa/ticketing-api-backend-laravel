<!DOCTYPE html>
<html>
    <head>
        <title>Studio</title>
    </head>
    <body>
        <h1>Daftar Studio</h1>
        @foreach ($studios as $studio)
            <h2>{{ $studio->studio_name }}</h2>
            <p>Capacity: {{ $studio->capacity }}</p>
            <p>Description: {{ $studio->description }}</p>
        @endforeach
    </body>
</html>