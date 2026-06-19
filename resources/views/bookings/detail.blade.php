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
        <tr><td>Film</td>         <td>{{ $booking->showtime->movie->title }}</td></tr>
        <tr><td>Tanggal</td>      <td>{{ $booking->showtime->show_date }}</td></tr>
        <tr><td>Jam</td>          <td>{{ $booking->showtime->show_time }}</td></tr>
        <tr>
            <td>Kursi</td>
            <td>{{ $booking->seats->pluck('seat_code')->join(', ') }}</td>
        </tr>
        <tr><td>Status</td>       <td>{{ $booking->status }}</td></tr>
    </table>

    <a href="{{ route('movies.index') }}">OK</a>
</body>
</html>