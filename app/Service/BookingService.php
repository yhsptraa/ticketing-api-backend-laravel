<?php

namespace App\Service;

use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Schedule;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\carbon;

class BookingService {
    public function getBookedSeatIds(int $scheduleId): array {
        return BookingSeat::whereHas('booking', function($query) use ($scheduleId) {
            $query->where('schedule_id', $scheduleId)
                  ->whereIn('status', ['pending', 'confirmed']);
        })
        ->pluck('seat_id')
        ->toArray();
    }

    public function checkSeatAvailability(int $scheduleId, array $seatIds): array {
        $bookedSeatIds = $this->getBookedSeatIds($scheduleId);
        $BookedSeats = [];

            foreach ($seatIds as $seatId) {
                if (in_array($seatId, $bookedSeatIds)) {
                    $seat = Seat::find($seatId);
                    $BookedSeats[]  = $seat ? $seat->seat_code : $seatId;
                }
            }

        return $BookedSeats;
    }

    public function generateBookingCode(): string {
        return strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
    }

    public function createBooking(int $userId, int $scheduleId, array $seatIds): Booking {

        $schedule = Schedule::findOrFail($scheduleId);
        
        $unavailable = $this->checkSeatAvailability($scheduleId, $seatIds);

        if(!empty($unavailable)) {
            throw ValidationException::withMessages([
                'seats' => 'beberapa kursi sudah dipesan, silahkan pilih kursi lain',
            ]);
        }

            $price = $schedule->price;
            $totalPrice = $price * count($seatIds);

            $expiredAt = Carbon::now()->addMinutes(15);

            return DB::transaction(function () use ($userId, $scheduleId, $seatIds, $totalPrice, $price, $expiredAt) {
            $booking = Booking::create([
                'booking_code' => $this->generateBookingCode(),
                'user_id'      => $userId,
                'schedule_id'  => $scheduleId,
                'total_seats'  => count($seatIds),
                'total_price'  => $totalPrice,
                'status'       => 'pending',
                'booked_at'    => now(),
                'expired_at'   => $expiredAt,
            ]);

            $bookingSeatData = array_map(fn ($seatId) => [
                'booking_id' => $booking->id,
                'seat_id'    => $seatId,
                'price'      => $price,
                'created_at' => now(),
                'updated_at' => now(),
            ], $seatIds);

            BookingSeat::insert($bookingSeatData);

            return $booking->load(['schedule.movie', 'schedule.studio', 'seats']);

            });
    }
}