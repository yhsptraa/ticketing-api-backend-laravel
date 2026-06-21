<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Booking Berhasil!</h2>

    <table>
        <tr><td>Kode Booking</td> <td>{{ $booking->booking_code }}</td></tr>
        <tr><td>Film</td>         <td>{{ $booking->schedule->movie->title }}</td></tr>
        <tr><td>Jam</td>          <td>{{ $booking->schedule->show_time }}</td></tr>
        <tr>
            <td>Kursi</td>
            <td>{{ $booking->seats->pluck('seat_code')->join(', ') }}</td>
        </tr>
        <tr><td>Status</td>       <td>{{ $booking->status }}</td></tr>
    </table>


    <a href="{{ route('movies.index') }}">
        <button>Ok</button>
    </a>
</body>
</html>