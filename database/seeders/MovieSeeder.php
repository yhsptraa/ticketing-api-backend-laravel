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
        Movie::create([
        'title' => 'Top Gun: Maverick',
        'description' => 'Seorang pilot veteran kembali melatih generasi baru pilot tempur.',
        'genre' => 'Action, Drama',
        'duration' => 131,
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/1/13/Top_Gun_Maverick_Poster.jpg'
    ]);

    Movie::create([
        'title' => 'How to Train Your Dragon',
        'description' => 'Hiccup menjalin persahabatan dengan naga Toothless.',
        'genre' => 'Animation, Adventure, Fantasy',
        'duration' => 98,
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/9/99/How_to_Train_Your_Dragon_Poster.jpg'
    ]);

    Movie::create([
        'title' => 'Dune',
        'description' => 'Paul Atreides menghadapi konflik di planet Arrakis.',
        'genre' => 'Sci-Fi, Adventure',
        'duration' => 155,
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/8/8e/Dune_%282021_film%29.jpg'
    ]);

    Movie::create([
        'title' => 'Moana',
        'description' => 'Seorang gadis pemberani berlayar untuk menyelamatkan rakyatnya.',
        'genre' => 'Animation, Adventure',
        'duration' => 107,
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/2/26/Moana_Teaser_Poster.jpg'
    ]);
        }
    }