<?php 

namespace App\Http\Request\Booking;

use Illuminate\Foundation\Http\FormRequest;

class SelectSeatsRequest extends FormRequest
{
    public function authorize() { return auth()->check(); }

    public function rules() {
        return [
            'seat_ids'   => ['required', 'array', 'min:1', 'max:6'],
            'seat_ids.*' => ['exists:seats,id'],
        ];
    }
}