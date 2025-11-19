<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Session;
use Carbon\Carbon;

class HallsSessionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        for ($i = 1; $i <= 4; $i++) {
            Session::create([
                'hall_schedule_id' => $i,
                'hall_id' => $i,
                'start_time' => $now->copy()->addHours($i),
                'end_time' => $now->copy()->addHours($i + 2),
            ]);
        }
    }
}
