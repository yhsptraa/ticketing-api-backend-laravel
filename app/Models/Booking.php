<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = [
        'user_id',
        'booking_id',
        'total_price', 
        'status'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function schedule(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Schedule::class);
    }

    public function seat(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Seat::class);
    }
}