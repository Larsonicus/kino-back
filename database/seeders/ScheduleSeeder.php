<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use App\Models\CinemaSchedule;
use App\Models\HallSchedule;
use App\Models\Movie;
use App\Models\Hall;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::pluck('id');
        $halls = Hall::all();

        if ($movies->isEmpty() || $halls->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 7; $i++) {

            $date = Carbon::today()->addDays($i);

            $schedule = Schedule::create([
                'date' => $date->toDateString(),
                'movie_id' => $movies->random(),
            ]);

            $cinemaSchedules = $halls
                ->pluck('cinema_id')
                ->unique()
                ->mapWithKeys(function ($cinemaId) use ($schedule) {
                    $cs = CinemaSchedule::create([
                        'schedule_id' => $schedule->id,
                        'cinema_id' => $cinemaId,
                    ]);

                    return [$cinemaId => $cs->id];
                });

            $hallSchedules = $halls->mapWithKeys(function ($hall) use ($cinemaSchedules) {
                $hs = HallSchedule::create([
                    'hall_id' => $hall->id,
                    'cinema_schedule_id' => $cinemaSchedules[$hall->cinema_id],
                ]);

                return [$hall->id => $hs->id];
            });

            $sessions = $halls->flatMap(function ($hall) use ($date, $hallSchedules) {

                $times = [10, 13, 16];

                return collect($times)->map(function ($hour) use ($hall, $date, $hallSchedules) {

                    $start = $date->copy()->setTime($hour, 0);
                    $end = $start->copy()->addHours(2);

                    return [
                        'hall_schedule_id' => $hallSchedules[$hall->id],
                        'hall_id' => $hall->id,
                        'start_time' => $start,
                        'end_time' => $end,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                });
            });

            DB::table('halls_sessions')->insert($sessions->toArray());
        }
    }
}
