<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Resources\CalendarResource;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Models\HallSession;
use App\Dto\GetCalendarDto;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $dto = GetCalendarDto::fromRequest($request);
        $cityId = $dto->cityId;

        $start = now()->startOfDay();
        $end = now()->addDays(30)->endOfDay();
        $period = \Carbon\CarbonPeriod::create($start, $end);
        $dates = collect($period)->map(fn($d) => $d->toDateString());

        $sessions = HallSession::with(['hall', 'hall.cinema'])
            ->whereBetween('start_time', [$start, $end])
            ->whereHas('hall.cinema', fn($q) => $q->where('city_id', $cityId))
            ->get()
            ->map(function($session) {
                $totalSeats = $session->hall->seats()->count();
                $reservedSeats = $session->reservedSeats()->count();
                $session->free_seats_count = $totalSeats - $reservedSeats;
                return $session;
            })
            ->groupBy(fn($s) => Carbon::parse($s->start_time)->toDateString());

        $calendarItems = $dates->map(fn($date) => (object)[
            'date' => $date,
            'sessions_by_date' => collect($sessions->get($date)),
        ]);

        return CalendarResource::collection($calendarItems);
    }
}
