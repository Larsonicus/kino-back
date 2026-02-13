<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call([
            CitiesTableSeeder::class,
            CinemasTableSeeder::class,
            HallsTableSeeder::class,
            SeatsTableSeeder::class,
            MoviesTableSeeder::class,
            SchedulesTableSeeder::class,
            CinemaSchedulesTableSeeder::class,
            HallSchedulesTableSeeder::class,
            HallsSessionsTableSeeder::class,
            SessionsSeatsReserveTableSeeder::class,
            PermissionsSeeder::class
        ]);
    }
}
