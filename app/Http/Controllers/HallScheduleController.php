<?php

namespace App\Http\Controllers;

use App\Models\HallSchedule;
use Illuminate\Http\Request;

class HallScheduleController extends Controller
{
    public function index()
    {
        return HallSchedule::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hall_id' => 'required|integer'
        ]);

        return HallSchedule::create($validated);
    }

    public function show($id)
    {
        return HallSchedule::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'hall_id' => 'required|integer'
        ]);

        $schedule = HallSchedule::findOrFail($id);
        $schedule->update($validated);

        return $schedule;
    }

    public function destroy($id)
    {
        return HallSchedule::destroy($id);
    }
}
