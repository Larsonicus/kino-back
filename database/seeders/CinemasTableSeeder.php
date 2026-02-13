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
                'contact_number' => '+7 (123) 456-78-90',
                'working_hours' => '10:00 - 22:00',
                'name' => 'Big City',
            ],
            [
                'city_id' => 1,
                'address' => 'пр. Мира, 25',
                'lat' => 55.7642,
                'long' => 37.6185,
                'contact_number' => '+7 (123) 456-78-90',
                'working_hours' => '10:00 - 22:00',
                'name' => 'Cinema City',
            ],
            [
                'city_id' => 2,
                'address' => 'ул. Пушкина, 5',
                'lat' => 59.9343,
                'long' => 30.3351,
                'contact_number' => '+7 (123) 456-78-90',
                'working_hours' => '10:00 - 22:00',
                'name' => 'Another Cinema',
            ],
        ];

        DB::table('cinemas')->insert($cinemas);
    }
}
