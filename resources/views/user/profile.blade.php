<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - CineTicket</title>
</head>
<body>
    <h1>Profil Saya</h1>

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    <p><strong>Bergabung:</strong> {{ $user->created_at->format('d M Y') }}</p>

    <br>
    <a href="{{ route('user.history') }}">Riwayat Booking</a> |
    <a href="{{ route('movies.index') }}">Daftar Film</a> |

    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
