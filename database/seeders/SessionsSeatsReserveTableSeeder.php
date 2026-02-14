<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HallSession;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class SessionsSeatsReserveTableSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = HallSession::all();

        foreach ($sessions as $session) {
            $allSeats = Seat::where('hall_id', $session->hall_id)->get();

            $countReserved = max(1, intval($allSeats->count() * 0.3));
            $reservedSeats = $allSeats->shuffle()->take($countReserved);

            $existingSeatIds = $session->reservedSeats()->pluck('seat_id')->toArray();
            $newSeatIds = $reservedSeats->pluck('id')->diff($existingSeatIds)->toArray();

            $session->reservedSeats()->attach($newSeatIds);
        }
    }
}
