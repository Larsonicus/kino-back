<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use App\Http\Resources\SeatResource;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::get();
        return SeatResource::collection($seats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'row' => 'required|integer|min:1',
            'col' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'hall_id' => 'required|exists:halls,id',
        ]);

        $seat = Seat::create($validated);

        return response()->json($seat, 201);
    }

    public function show($id)
    {
        $seat = Seat::with('hall')->findOrFail($id);
        return response()->json($seat);
    }

    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);

        $validated = $request->validate([
            'row' => 'sometimes|integer|min:1',
            'col' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
            'hall_id' => 'sometimes|exists:halls,id',
        ]);

        $seat->update($validated);

        return response()->json($seat);
    }

    public function destroy($id)
    {
        $seat = Place::findOrFail($id);
        $seat->delete();

        return response()->json(['message' => 'Seat deleted']);
    }
}
