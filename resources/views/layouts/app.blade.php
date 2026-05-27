<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineTicket')</title>
</head>
<body>

<nav>
    <strong>CineTicket</strong>
    &nbsp;&nbsp;
    <a href="{{ route('movies.index') }}">Movies</a> |
    <a href="{{ route('user.profile') }}">Profile</a> |
    <a href="{{ route('user.history') }}">Booking History</a> |
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<hr>

@yield('content')

</body>
</html>
