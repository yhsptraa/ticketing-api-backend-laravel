<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Ringkasan Pembayaran</h2>

    <table>
        <tr><td>Film</td>    <td>{{ $summary['movie']->title }}</td></tr>
        <tr><td>Jadwal</td>     <td>{{ $summary['showtime']->show_time }}</td></tr>
        <tr>
            <td>Kursi</td>
            <td>{{ $summary['seats']->pluck('seat_code')->join(', ') }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>Rp{{ number_format($summary['total_price'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <form action="{{ route('bookings.payment.process') }}" method="POST">
        @csrf
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>