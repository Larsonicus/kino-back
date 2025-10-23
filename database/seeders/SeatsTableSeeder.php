<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder
{
    public function run(): void
    {
        $places = [];

        for ($hallId = 1; $hallId <= 4; $hallId++) {
            for ($row = 1; $row <= 10; $row++) {
                for ($col = 1; $col <= 15; $col++) {
                    $places[] = [
                        'row' => $row,
                        'col' => $col,
                        'price' => rand(500, 2500),
                        'hall_id' => $hallId,
                    ];
                }
            }
        }

        DB::table('seats')->insert($places);
    }
}

