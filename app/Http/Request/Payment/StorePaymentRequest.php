<?php 

namespace App\Http\Request\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorepaymentRequest extends FormRequest {
    public function authorize(): bool {
        return $this->user() && $this->user()->role === 'customer';
    }

    public function rules(): array {
        return [
            'booking_id' => [
                'required',
                'integer',
                'exist:bookings,id',
            ],
            'method' => [
                'required',
                'in:transfer,QRIS'
            ],
        ];
    }

    public function messages(): array {
        return [
            'booking_id.required' => 'ID booking harus diisi',
            'booking_id.exist' => 'Booking tidak ditemukan',
            'method.required' => 'Metode pembayaran harus dipilih',
            'method.in' => 'Metode pembayaran tidak valid',
        ];
    }
}