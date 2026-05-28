<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        'studio_name',
        'capacity',
        'description',
        'is_active',
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
