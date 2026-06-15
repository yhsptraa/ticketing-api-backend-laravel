<?php 

namespace App\Http\Controllers;

use App\Http\Request\Payment\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Services\PaymentServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller {
    public function __construct(private readonly PaymentService $paymetService) {

    }

    public function store(StorePaymentRequest $request): \Illuminate\Http\JsonResponse {
        try {
            $payment = $this->paymentService->processPayment(
                userId: $request->user()->id, 
                bookingId: $request->validated('booking_id'),
                method: $request->validated
            );

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran Berhasil!',
                'data' => new PaymentResource($payment),
            ], 201);
        } catch (\Exception $e) {
            $code = in_array($e->getCode(), [404, 409, 422]) ? $e->getCode : 500;


            if ($code === 500) {
                Log::error('Payment error: ' . $e->getMessage(), [
                    'user_id' => $request->user()->id,
                    'booking_id' => $request->booking_id,
                ], $code);
            }

            return response()->json([
                'success' => false,
                'message' => $code === 500 ? 'Terjadi kesalahan sistem' : $e->getMessage(),
            ], $code);
        }
    }

    public function show(Request $request, int $id): \Illuminate\Http\jsonResponse {
        $payment = Payment::with(['booking.schedule.movie', 'booking.seats', 'booking.user'])->findOrFail($id);

        if ($request->user()->role === 'customer' && $payment->booking-> user_id != $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Not Found', 404]);
        }

        return response()->json([
            'success' => true,
            'data' => new PaymentResource($payment),
        ]);
    }
}