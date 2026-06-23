<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking-Seats</title>
    <style>


    .seat-grid {
        display: grid;
        grid-template-columns: repeat(6, max-content);
        gap: 10px;
        margin-bottom: 20px;
    }
</style>
</head>
<body>
    <h2>{{ $showtime->movie->title }}</h2>

<div style="padding-bottom: 2.5em;">▬▬▬ SCREEN ▬▬▬</div>

<form action="{{ route('bookings.seats.select') }}" method="POST">
    @csrf
    <div class="seat-grid">
        @foreach ($seats as $seat)
            @php $isBooked = in_array($seat->id, $bookedSeatsIds); @endphp

            <label class="{{ $isBooked ? 'booked' : 'available' }}">
                <input
                    type="checkbox"
                    name="seat_ids[]"
                    value="{{ $seat->id }}"
                    {{ $isBooked ? 'disabled' : '' }}
                >
                {{ $seat->seat_code }}
            </label>
        @endforeach
    </div>

    <button type="submit">Confirm</button>
</form>
</body>
</html>