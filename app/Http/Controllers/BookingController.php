<?php 

namespace App\Http\Controllers;

use app\Models\Booking;
use app\Models\Movie;
use app\Models\Schedule;
use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller {

    public function bookingRequest(StoreBookingRequest $request) {
        return DB::transaction(function () use ($request){
            $schedule = Schedule::findOrFail($request->schedule_id);

            $booking = booking::create([
                'user_id' => auth()->id(),
                'schedule_id' => $schedule->id,
                'status' => 'pending'
            ]);

            $seat->update(['is_available => false']);

            return redirect()->route('booking.payment', $booking->id);
        });
    }

    public function selectSchedule(int $movieId) {
        $schedules = Schedule::with('movie')
            ->where('movie_id', $movieId)
            ->where('show_date', '>=', today())
            ->orderBy('show_time')
            ->get();

            return view('booking.select-schedule', compact('schedules'));
    }

    public function selectSeat(int $scheduleId) {
        $schedule = Schedule::with('movie')->findOrFail($scheduleId);

        $seats = Seat::where('schedule_id', $scheduleId)
            ->orderBy('seat_number')
            ->get();

        return view('booking.select-seat', compact('schedule', 'seats'));
    }
}