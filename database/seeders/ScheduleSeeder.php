<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        Schedule::create([
            'movie_id' => 1,
            'studio_id' => 1,
            'show_time' => '2026-05-28 19:00:00',
            'price' => 50000
        ]);

        Schedule::create([
            'movie_id' => 2,
            'studio_id' => 2,
            'show_time' => '2026-05-29 20:30:00',
            'price' => 60000
        ]);

        Schedule::create([
            'movie_id' => 3,
            'studio_id' => 3,
            'show_time' => '2026-05-30 18:15:00',
            'price' => 55000
        ]);
    }
}