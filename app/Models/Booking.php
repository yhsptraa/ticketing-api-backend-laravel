<?php 

namespace App\Models;

use App\Models\BookingSeat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function bookingSeat(): HasMany {
        return $this->hasMany(BookingSeat::class);
    }

    public function seats(): BelongsToMany {
        return $this->belongsToMany(Seat::class, 'booking_seats', 'booking_id', 'seat_id')->withPivot('price');
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class);
    }

}