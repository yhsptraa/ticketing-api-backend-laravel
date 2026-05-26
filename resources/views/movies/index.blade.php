<h1>MOVIE LIST</h1>

<a href="/movies/create">Tambah Movie</a>

<hr>

@foreach ($movies as $movie)

    <img src="{{ $movie->poster }}" width="200">

    <h2>{{ $movie->title }}</h2>

    <p>{{ $movie->genre }}</p>

    <a href="/movies/{{ $movie->id }}">
        Detail
    </a>

    |

    <a href="/movies/{{ $movie->id }}/edit">
        Edit
    </a>

    |

    <form action="/movies/{{ $movie->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>
    </form>

    <hr>

@endforeach