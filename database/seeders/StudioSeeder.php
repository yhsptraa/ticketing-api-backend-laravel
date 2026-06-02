<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{   
    public function run(): void
    {
        Studio::create([
            'studio_name' => 'Studio 1',
            'capacity' => 100,
            'description' => 'Regular Studio',
            'is_active' => true,
            'image' => 'https://d2v6npc8wmnkqk.cloudfront.net/storage/tinymce/K1khg00o6sXShRJvhz0wyHdI9yRzr1B5sKCktLbm.webp'
        ]);

        Studio::create([
            'studio_name' => 'Studio 2',
            'capacity' => 50,
            'description' => 'Premium Studio',
            'is_active' => true,
            'image' => 'https://d2v6npc8wmnkqk.cloudfront.net/storage/tinymce/x5yN3R1jetsCpcbAoRHwkPlJ5FP4g6B5Z8UpqKAw.webp'
        ]);

        Studio::create([
            'studio_name' => 'Studio 3',
            'capacity' => 250,
            'description' => 'IMAX Studio',
            'is_active' => false,
            'image' => 'https://d2v6npc8wmnkqk.cloudfront.net/storage/tinymce/4HKUtP7Rr18lDLa0dhdkQ1c1UVAKqp0jLs6wH4Pc.webp'
        ]);

    }
}
