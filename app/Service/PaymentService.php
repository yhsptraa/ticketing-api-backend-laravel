<?php 

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentService {
    private function generatePaymentCode(): string {
        do {
            $code = now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Payment::where('payment_code', $code)->exists());

        return $code;
    }

    public function processPayment(int $userId, int $bookingId, string $method): Payment {
        $booking = Booking::findOrFail($bookingId);

        if($booking->user_id != $userId) {
            throw new \Exception('Booking tidak ditemukan', 404);
        }

        if($booking->status !== 'pending') {
            throw new \Exception('Booking Status : ' . $booking->status , 422);
        }

        if($booking->expired_at && now()->isAfter($booking->expired_at)) {
            $booking->update(['status' => 'cancelled']);
            throw new \Exception('Booking expired, dan otomatis dibatalkan');
        }

        if($booking->payment) {
            throw new \Exception('Pembayaran untuk booking ini sudah ada', 402);
        }

        return DB::transaction(function () use($booking, $method){
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'payment_code' => this->generatPaymentCode(),
                'amount' => $booking->total_price,
                'status' => 'paid',
                'paid_at' => now(),
                'expired_at' => now()->addHours(24),
            ]);

            $booking->update(['status' => 'confirmed']);
            return $payment->load('booking.schedule.movie', 'booking.seats');
        });
    }
}