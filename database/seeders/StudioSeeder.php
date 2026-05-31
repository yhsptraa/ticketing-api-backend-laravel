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
            'is_active' => true
        ]);

        Studio::create([
            'studio_name' => 'Studio 2',
            'capacity' => 20,
            'description' => 'Premium Studio',
            'is_active' => true
        ]);

        Studio::create([
            'studio_name' => 'Studio 3',
            'capacity' => 250,
            'description' => 'IMAX Studio',
            'is_active' => false
        ]);

        Studio::create([
            'studio_name' => 'Studio 4',
            'capacity' => 50,
            'description' => '4DX Studio',
            'is_active' => true
        ]);
    }
}
