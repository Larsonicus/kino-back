<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    public function run(): void
    {
        Movie::create([
            'image' => 'https://kinopoiskapiunofficial.tech/images/posters/kp/2213.jpg',
            'name' => 'Inception',
            'description' => 'A mind-bending thriller about dreams within dreams.',
            'age' => '13+',
            'year' => 2010,
            'genres' => ['Sci-Fi', 'Thriller', 'Action'],
            'countries' => ['USA', 'UK'],
            'rating_kinopoisk' => 8.7,
        ]);

        Movie::create([
            'image' => 'https://kinopoiskapiunofficial.tech/images/posters/kp/1048334.jpg',
            'name' => 'The Matrix',
            'description' => 'A hacker discovers the shocking truth about reality.',
            'age' => '16+',
            'year' => 1999,
            'genres' => ['Sci-Fi', 'Action'],
            'countries' => ['USA'],
            'rating_kinopoisk' => 8.9,
        ]);
    }
}
