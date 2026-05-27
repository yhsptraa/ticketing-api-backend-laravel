<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - CineTicket</title>
</head>
<body>
    <h1>Riwayat Booking</h1>

    <a href="{{ route('user.profile') }}">Kembali ke Profil</a>

    <br><br>

    @if ($bookings->isEmpty())
        <p>Belum ada booking.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Studio</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Kursi</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->schedule->movie->title }}</td>
                        <td>{{ $booking->schedule->studio }}</td>
                        <td>{{ $booking->schedule->date }}</td>
                        <td>{{ $booking->schedule->time }}</td>
                        <td>{{ $booking->seat_number }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($booking->payment_status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
