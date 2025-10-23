<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('halls')->insert([
            ['name' => 'Большой зал', 'city_id' => 1],
            ['name' => 'Малый зал', 'city_id' => 1],
            ['name' => 'Театр на Неве', 'city_id' => 2],
            ['name' => 'Концертный центр', 'city_id' => 3],
        ]);
    }
}
