<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json(Schedule::all());
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
