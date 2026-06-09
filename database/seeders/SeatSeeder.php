<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Regular studio
        $this->seats(1,10);

        // Premium studio
        $this->seats(2,5);

        // IMAX studio
        $this->seats(3,25);
    }

    private function seats($studio_id, $rows) {
        for ($row = 0; $row < $rows; $row++) {
            $rowLetter = chr(65 + $row);
            for ($column = 1; $column <= 10; $column++) {
                Seat::create([
                    'studio_id' => $studio_id,
                    'seat_number' => $rowLetter . $column,
                    'is_available' => true,
                ]);
            }
        }   
    }

}
