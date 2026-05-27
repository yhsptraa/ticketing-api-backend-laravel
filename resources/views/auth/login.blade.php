<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CineTicket</title>
</head>
<body>
    <h1>Login</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <button type="submit">Login</button>
    </form>

    <br>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</body>
</html>
