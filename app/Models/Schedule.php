<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'movie_id',
        'studio_id',
        'show_time',
        'price'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function studio() {
        return $this->belongsTo(Studio::class);
    }

    public function seats() {
        return $this->hasMany(Seat::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}