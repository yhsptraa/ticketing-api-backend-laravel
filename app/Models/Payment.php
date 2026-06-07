<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = [
        'booking_id',
        'amount',
        'method',
        'status',
        'paid_at',
        'expired_at',
    ];

    protected $cast = [
        'paid_at' => 'datetime',
        'expired_at'=> 'datetime'
    ];

    public function booking(): BelongsTo {
        return $this->belongsTo(Booking::class);
    }
}