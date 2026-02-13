<?php

namespace App\Http\Controllers;

use App\Models\HallSchedule;
use Illuminate\Http\Request;
use App\Http\Resources\HallScheduleResource;

class HallScheduleController extends Controller
{
    public function index()
    {
        return HallSchedule::all();
    }

    public function show($id)
    {
        $hallSchedule = HallSchedule::findOrFail($id);
        return new HallScheduleResource($hallSchedule);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hall_id' => 'required|integer'
        ]);

        return HallSchedule::create($validated);
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
