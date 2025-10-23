<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class SchedulesTableSeeder extends Seeder
{
    public function run(): void
    {
        Schedule::create([
            'date' => '2023-01-01',
            'movie_id' => 1
        ]);

        Schedule::create([
            'date' => '2023-01-02',
            'movie_id' => 2
        ]);
    }
}
