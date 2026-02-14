<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use App\Dto\GetSchedulesDto;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $dto = GetSchedulesDto::fromRequest($request);
        $cityId = $dto->cityId;

        $schedules = Schedule::with([
            'movie',
            'cinemaSchedules.cinema.city',
            'cinemaSchedules.hallSchedules.hall',
            'cinemaSchedules.hallSchedules.sessions.reservedSeats'
        ])
        ->whereDate('date', $dto->date)
        ->get()
        ->map(function($schedule) use ($cityId) {
            $schedule->setRelation('cinemaSchedules',
                $schedule->cinemaSchedules->filter(function($cinemaSchedule) use ($cityId) {
                    return $cinemaSchedule->cinema->city_id == $cityId
                        && $cinemaSchedule->hallSchedules->isNotEmpty();
                })
            );

            return $schedule;
        })
        ->filter(function($schedule) {
            return $schedule->cinemaSchedules->isNotEmpty();
        });

        return ScheduleResource::collection($schedules);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $schedule = Schedule::create($data);

        return response()->json($schedule, 201);
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return response()->json($schedule);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $data = $request->validate([
            'date' => 'sometimes|date',
            'movie_id' => 'sometimes|exists:movies,id',
        ]);

        $schedule->update($data);

        return response()->json($schedule);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(['message' => 'Movie deleted successfully.']);
    }
}
