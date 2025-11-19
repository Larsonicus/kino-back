<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CinemaSchedule;

class CinemaSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            ['schedule_id' => 1, 'cinema_id' => 1],
            ['schedule_id' => 1, 'cinema_id' => 2],
            ['schedule_id' => 2, 'cinema_id' => 1],
            ['schedule_id' => 2, 'cinema_id' => 2],
        ];

        CinemaSchedule::insert($schedules);
    }
}
