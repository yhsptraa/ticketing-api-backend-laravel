<?php 

namespace App\Http\Request\Booking;

use Illuminate\Foundation\Http\FormRequest;

class SelectShowtimeRequest extends FormRequest {
    // public function authorize() { 
    //     return auth()->check();
    // }

    public function rules() {
        return ['schedule_id' => ['required', 'exists:schedules,id'],];
    }
}