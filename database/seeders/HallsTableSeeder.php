<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Cinema;
use App\Models\Hall;

class HallsTableSeeder extends Seeder
{
    public function run(): void
    {
        $halls = [];

        $cinemas = Cinema::all();

        $halls = Cinema::all()->flatMap(function ($cinema) {
            return [
                ['name' => 'Большой зал', 'cinema_id' => $cinema->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Малый зал', 'cinema_id' => $cinema->id, 'created_at' => now(), 'updated_at' => now()],
            ];
        });

        Hall::insert($halls->toArray());
    }
}
