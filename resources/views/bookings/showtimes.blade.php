<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="{{ route('bookings.showtimes.select') }}" method="POST">
        @csrf

        <h2>{{ $movie->title }}</h2>
        @foreach ($schedules as $schedule)
            <div style="margin-bottom: 15px;">
                <p>Studio : </p>

                <input type="radio" name="schedule_id" 
                value="{{ $schedule->id }}">
                {{ $schedule->show_time }}

               <p>Harga : Rp {{ $schedule->price }}</p>
            </div>
        @endforeach
            <button type="submit">Confirm</button>
    </form>

</body>
</html>