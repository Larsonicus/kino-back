<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CinemasTableSeeder extends Seeder
{
    public function run(): void
    {
        $cinemas = [
            [
                'city_id' => 1,
                'address' => 'ул. Ленина, 10',
                'lat' => 55.7558,
                'long' => 37.6173,
            ],
            [
                'city_id' => 1,
                'address' => 'пр. Мира, 25',
                'lat' => 55.7642,
                'long' => 37.6185,
            ],
            [
                'city_id' => 2,
                'address' => 'ул. Пушкина, 5',
                'lat' => 59.9343,
                'long' => 30.3351,
            ],
        ];

        DB::table('cinemas')->insert($cinemas);
    }
}
