<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking-Showtime</title>
</head>
<body>
    
    <form action="{{ route('bookings.showtimes.select') }}" method="POST">
        @csrf

        <h2>{{ $movie->title }}</h2>
        
        <p>Studio: {{ $schedules->first()->studio->studio_name ?? '-' }}</p>
        <p>Harga: Rp {{ number_format($schedules->first()->price ?? 0, 0, ',', '.') }}</p>
            

        <div style="margin-bottom:1em">Pilih Jam Tayang:</div>

        @foreach ($schedules as $schedule)
            <div style="margin-bottom: 15px;">
                <input type="radio" name="schedule_id" value="{{ $schedule->id }}">
                {{ \Carbon\Carbon::parse($schedule->show_time)->format('H:i') }}
            </div>
        @endforeach
            <button type="submit">Confirm</button>
    </form>

</body>
</html>