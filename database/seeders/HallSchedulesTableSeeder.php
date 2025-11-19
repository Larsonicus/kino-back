<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HallSchedule;

class HallSchedulesTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 4; $i++) {
            HallSchedule::create([
                'hall_id' => $i,
            ]);
        }
    }
}
