<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'studio_id',
        'seat_number',
        'is_available',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
