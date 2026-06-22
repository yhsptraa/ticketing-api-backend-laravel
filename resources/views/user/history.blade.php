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
                    <th>Booking Code</th>
                    <th>Movie</th>
                    <th>Studio</th>
                    <th>Show Time</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_code }}</td>
                        <td>{{ $booking->schedule->movie->title }}</td>
                        <td>{{ $booking->schedule->studio->studio_name ?? '-' }}</td>
                        <td>{{ $booking->schedule->show_time }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
