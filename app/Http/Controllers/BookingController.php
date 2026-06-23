<?php 

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Studio;
use App\Models\Seat;
use App\Service\BookingService;
use App\Http\Request\Booking\selectShowtimeRequest;
use App\Http\Request\Booking\selectSeatRequest;
use Illuminate\Http\Request;

class BookingController extends Controller {
    public function __construct(private readonly BookingService $bookingService) {

    }

    public function showSchedule(Movie $movie) {
        $schedules = Schedule::where('movie_id', $movie->id)
            ->orderBy('show_time')
            ->get();

        return view('bookings.showtimes', compact('movie','schedules'));
    }

    public function selectShowtime(SelectShowtimeRequest $request) {
        $showtime = Schedule::findOrFail($request->schedule_id);

        session()->put('booking.movie_id', $showtime->movie_id);
        session()->put('booking.schedule_id', (int) $request->schedule_id);
        
        return redirect()->route('bookings.seats');
    }

    public function showSeats() {
        if (!session()->has('booking.schedule_id')) {
            return redirect()->route('bookings.movies');
        }
        
        $showtime = Schedule::with('movie')
            ->findOrFail(session('booking.schedule_id'));

        $studio = $showtime->studio;

        $seats = Seat::where('studio_id', $studio->id)->get();

            $bookedSeatsIds = $showtime->bookings()
                ->whereIn('status', ['pending', 'confirmed'])
                ->with('seats')
                ->get()
                ->flatMap(fn($b) => $b->seats->pluck('id'))
                ->unique()
                ->toArray();

        return view('bookings.seats', compact('showtime', 'seats', 'bookedSeatsIds'));
    }

    public function selectSeats(Request $request) {
        
        $request->validate(['seat_ids' => 'required|array|min:1',], ['seat_ids.required' => 'Silakan pilih minimal satu kursi terlebih dahulu!']);

        $showtime  = Schedule::with('movie')->findOrFail(session('booking.schedule_id'));
        $seatIds   = $request->seat_ids;
        $total     = count($seatIds) * $showtime->price;

        session()->put('booking.seat_ids', $seatIds);
        session()->put('booking.total_price', $total);
        return redirect()->route('bookings.payment');
    }

    public function showPayment() {
        $showtime = Schedule::with('movie')
            ->findOrFail(session('booking.schedule_id'));

        $seats = \App\Models\Seat::whereIn('id', session('booking.seat_ids'))->get();

        $summary = [
            'movie'       => $showtime->movie,
            'showtime'    => $showtime,
            'seats'       => $seats,
            'total_price' => session('booking.total_price'),
        ];

        return view('bookings.payment', compact('summary'));
    }

    public function processPayment() {
        // $booking = $this->bookingService->createBooking(
        //     auth()->id(),
        //     session('booking.schedule_id'),
        //     session('booking.seat_ids'),
        //     session('booking.total_price'),
        // );
        $scheduleId = (int) session('booking.schedule_id');
        $seatIds    = (array) session('booking.seat_ids');
        $totalPrice = session('booking.total_price');

        $booking = $this->bookingService->createBooking(
            auth()->id(),
            $scheduleId,
            $seatIds,
            $totalPrice
        );

        $booking->update([
            'status' => 'confirmed'
        ]);

        session()->forget('booking');

        return redirect()->route('bookings.ticket', ['booking' => $booking->id]);
    }

    public function showTicket(Booking $booking) {
        abort_if($booking->user_id !== auth()->id(), 403);
        $booking->load(['schedule.movie', 'seats']);

        return view('bookings.detail', compact('booking'));
    }

    public function history() {
        $bookings = Booking::with([
            'schedule.movie',
            'seats'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

        return view('user.history', compact('bookings'));
    }

}