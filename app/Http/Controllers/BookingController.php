<?php 

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookingController extends Controller {
    public function __construct(private readonly BookingService $bookingService) {

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

    public function show(Request $request, int $id): \Illuminate\Http\JsonResponse {
        $booking = Booking::with(['schedule.movie',  'schedule.studio', 'seats', 'payment', 'user'])
                   ->findOrFail($id);
                   
        if ($request->user()->role === 'customer' && $booking->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new BookingResource($booking),
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