<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder
{
    public function run(): void
    {
        $places = [];

        $halls = DB::table('halls')->pluck('id');

        foreach ($halls as $hallId) {
            $rowCount = rand(5, 15);
            $colCount = rand(5, 15);

            for ($row = 1; $row <= $rowCount; $row++) {
                for ($col = 1; $col <= $colCount; $col++) {
                    $places[] = [
                        'row' => $row,
                        'col' => $col,
                        'price' => rand(500, 2500),
                        'hall_id' => $hallId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        DB::table('seats')->insert($places);
    }
}
