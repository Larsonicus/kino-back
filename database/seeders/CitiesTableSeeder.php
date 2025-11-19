<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Москва', 'lat' => 55.7558, 'long' => 37.6173],
            ['name' => 'Санкт-Петербург', 'lat' => 59.9343, 'long' => 30.3351],
            ['name' => 'Новосибирск', 'lat' => 55.0084, 'long' => 82.9357],
            ['name' => 'Екатеринбург', 'lat' => 56.8389, 'long' => 60.6057],
            ['name' => 'Казань', 'lat' => 55.7903, 'long' => 49.1347],
        ];

        City::insert($cities);
    }
}
