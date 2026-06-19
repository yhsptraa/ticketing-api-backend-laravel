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
use App\Http\Request\Booking\selectSeatsRequest;
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

        session([
            'booking.movie_id' => $showtime->movie_id,
            'booking.schedule_id' => $showtime->id,
        ]);
        
        return redirect()->route('bookings.seats');
    }

    public function showSeats() {
        if (!session()->has('booking.schedule_id')) {
            return redirect()->route('bookings.movies');
        }
        
        $showtime = Schedule::with(['studio.seats', 'movie'])
            ->findOrFail(session('booking.schedule_id'));

        $studio = Studio::where('studio_name', $showtime->studio)->firstOrFail();

        $seats = Seat::where('studio_id', $studio->id)->get();

            $bookedSeatsIds = $showtime->bookings()
                ->whereIn('status', ['pending', 'confirmed'])
                ->with('seats')
                ->get()
                ->flatMap(fn($b) => $b->seats->pluck('id'))
                ->unique()
                ->toArray();
            $bookedSeatsIds = [];

        return view('bookings.seats', compact('showtime', 'seats', 'bookedSeatsIds'));
    }

    public function selectSeats(Request $request) {
        $request->validate(['seat_ids' => 'required|array|min:1',], ['seat_ids.required' => 'Silakan pilih minimal satu kursi terlebih dahulu!']);

        $showtime  = Schedule::with('movie')->findOrFail(session('booking.schedule_id'));
        $seatIds   = $request->seat_ids;
        $total     = count($seatIds) * $showtime->movie->price;

        session([
            'booking.seat_ids'    => $seatIds,
            'booking.total_price' => $total,
        ]);

        return redirect()->route('bookings.payment');
    }

    public function showPayment() {
        // $this->requireSession(['booking.schedule_id', 'booking.seat_ids']);

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
        $booking = $this->bookingService->createBooking(
            auth()->id(),
            session('booking.schedule_id'),
            session('booking.seat_ids'),
            session('booking.total_price'),
        );

        session()->forget('booking');

        return redirect()->route('bookings.ticket', $booking);
    }

    public function showTicket() {
        abort_if($booking->user_id !== auth()->id(), 403);

        $booking->load(['schedule.movie', 'seats', 'ticket']);

        return view('booking.ticket', compact('booking'));
    }







    public function store(StoreBookingRequest $request): \Illuminate\Http\JsonResponse {
        try {
            $booking = $this->bookingService->createBooking(
                userId: $request->user()->id,
                scheduleId: $request->validated('schedule_id'),
                seatsIds: $request->validated('seat_ids'),
            );

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat, lakukan pembayaran sebelum ' . $booking->expired_at-> format('H:i'),
                'data' => new BookingResource($booking),
            ], 201);
        } catch (\Exception $e) {
            if($e->getCode() === 409) {
                $errorData = json_decode($e->getMessage(), true);
                return response()->json([
                    'success' => false,
                    'message' => $errorData['message'],
                    'data' => ['unavailable_seats' => $errorData['unvailable_seats']],
                ], 409);
            }

            Log::error('Booking error: ' . $e->getMessage(), [
                'user_id' => $request->user()->id,
                'schedule_id' => $request->schedule_id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan, Booking Gagal',
            ], 500);
        }
    }   

    public function index() {
        $bookings = Booking::with(['schedule.movie', 'schedule.studio', 'seats', 'payment'])
                    ->where('user_id', $request->user()->id)
                    ->latest()
                    ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => BookingResource::collection($bookings),
            'meta' => [
                'current_page' => $bookings->currentPage(),
                'last_page' => $bookings->lastPage(),
                'per_page' => $bookings->perPage(),
                'total' => $bookings->total(),
            ],
        ]);
    }

    public function cancel(Request $request, int $id): \Illuminate\Http\JsonResponse {
        $booking = Booking::where('user_id', $request->user()->id)
                          ->where('id', $id)
                          ->firstOrFail();
                          
        if ($booking->status !== 'pending') {
            return response()->json([
                'succcess' => false,
                'message' => 'Booking tidak bisa dibatalkan',
            ], 422);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibatalkan',
        ]);
    }
}