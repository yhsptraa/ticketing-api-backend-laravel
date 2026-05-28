<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::create([
            'title' => 'Avengers Endgame',
            'description' => 'Superhero Marvel melawan Thanos untuk menyelamatkan dunia.',
            'genre' => 'Action',
            'duration' => 181,
            'poster' => 'https://upload.wikimedia.org/wikipedia/en/0/0d/Avengers_Endgame_poster.jpg'
        ]);

        Movie::create([
            'title' => 'Interstellar',
            'description' => 'Perjalanan luar angkasa untuk mencari planet baru bagi umat manusia.',
            'genre' => 'Sci-Fi',
            'duration' => 169,
            'poster' => 'https://upload.wikimedia.org/wikipedia/en/b/bc/Interstellar_film_poster.jpg'
        ]);

        Movie::create([
            'title' => 'Spider-Man: No Way Home',
            'description' => 'Peter Parker menghadapi kekacauan multiverse.',
            'genre' => 'Action/Fantasy',
            'duration' => 148,
            'poster' => 'https://upload.wikimedia.org/wikipedia/en/0/00/Spider-Man_No_Way_Home_poster.jpg'
        ]);
    }
}