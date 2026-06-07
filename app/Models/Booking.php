<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

    protected $fillable = [
        'booking_code',
        'user_id',
        'schedule_id',
        'total_seats',
        'total_price', 
        'status',
        'booked_at',
        'expired_at',
    ];

    protected $casts = [
        'booked_at' => 'datetime',
        'expired_at' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function schedule(): BelongsTo {
        return $this->belongsTo(Schedule::class);
    }


    public function seats(): BelongsToMany {
        return $this->belongsToManny(Seat::class, 'booking_seats')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class);
    }

}