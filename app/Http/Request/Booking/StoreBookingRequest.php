<?php 

namespace App\Http\Request\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest {
    public function authorize(): bool {
        return $this->user() && this->user()->role = 'customer';
    }

    public function rules(): array {
        return [
            'schedule_id' => [
                'required',
                'integer',
                'exists:schedules,id',

                function ($attribute, $value, $fail) {
                    $schedule = \App\Models\Schedule::find($value);
                    if (!$schedule || $schedule->status !== 'active') {
                        $fail('Jawal tayang tidak tersedia');
                    }

                    if ($schedule && $schedule->show_date < now()->toDateString()) {
                        fail('Jadwal tayang sudah lewat');
                    }
                },
            ],
            'seat_ids' => ['require', 'array', 'min:1'],
            'seat_ids.*' => ['required', 'integer', 'exist:seats,id', 'distinct'],
        ];
    }

    public function message(): array {
        return [
            'schedule_id.required' => 'Jadwal tayang harus dipilih',
            'seat_ids.required' => 'Kursi harus dipilih',
            'seat_ids.*.distinct' => 'Tidak bisa memilih kursi yang sama'
        ];
    }
}