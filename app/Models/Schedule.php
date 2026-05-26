<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'movie_id',
        'studio',
        'show_time',
        'price'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}