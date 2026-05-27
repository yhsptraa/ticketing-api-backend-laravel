@extends('layouts.app')

@section('title', 'Booking History - CineTicket')

@section('content')
    <h1>Booking History</h1>

    @if ($bookings->isEmpty())
        <p>No bookings yet.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Studio</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Seat</th>
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
@endsection
