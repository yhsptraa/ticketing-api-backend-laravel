<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking-Details</title>
</head>
<body>
    <h2>Booking Berhasil!</h2>

    <table style="margin-bottom:1em">
        <tr><td>Kode Booking</td> <td>{{ $booking->booking_code }}</td></tr>
        <tr><td>Film</td>         <td>{{ $booking->schedule->movie->title }}</td></tr>
        <tr><td>Jam Tayang</td>          <td>{{ \Carbon\Carbon::parse($booking->schedule->show_time)->translatedFormat('H:i') }}</td></tr>
        <tr>
            <td>Kursi</td>
            <td>{{ $booking->seats->pluck('seat_number')->join(', ') }}</td>
        </tr>
        <tr><td>Status</td>       <td>{{ $booking->status }}</td></tr>
    </table>

    <a href="{{ route('movies.index') }}">
        <button>Ok</button>
    </a>
</body>
</html>