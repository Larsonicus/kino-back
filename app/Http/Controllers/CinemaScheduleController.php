<?php

namespace App\Http\Controllers;

use App\Models\CinemaSchedule;
use Illuminate\Http\Request;

class CinemaScheduleController extends Controller
{
    public function index()
    {
        return CinemaSchedule::all();
    }

    public function show($id)
    {
        $schedule = CinemaSchedule::findOrFail($id);
        return $schedule;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'cinema_id' => 'required|exists:cinemas,id',
        ]);

        $schedule = CinemaSchedule::create($validated);

        return response()->json($schedule, 201);
    }

    public function update(Request $request, $id)
    {
        $schedule = CinemaSchedule::findOrFail($id);

        $validated = $request->validate([
            'schedule_id' => 'sometimes|exists:schedules,id',
            'cinema_id' => 'sometimes|exists:cinemas,id',
        ]);

        $schedule->update($validated);

        return response()->json($schedule);
    }

    public function destroy($id)
    {
        $schedule = CinemaSchedule::findOrFail($id);
        $schedule->delete();

        return response()->json(null, 204);
    }
}
