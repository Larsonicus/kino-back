<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('halls')->insert([
            ['name' => 'Большой зал', 'cinema_id' => 1],
            ['name' => 'Малый зал', 'cinema_id' => 1],
            ['name' => 'Театр на Неве', 'cinema_id' => 2],
            ['name' => 'Концертный центр', 'cinema_id' => 2],
        ]);
    }
}
