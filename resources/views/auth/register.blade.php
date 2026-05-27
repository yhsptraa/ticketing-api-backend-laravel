<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CineTicket</title>
</head>
<body>
    <h1>Register</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nama</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <br>

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <br>

        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <br>

        <div>
            <label for="password_confirmation">Konfirmasi Password</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <br>

        <button type="submit">Daftar</button>
    </form>

    <br>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</body>
</html>
