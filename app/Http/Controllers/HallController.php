<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HallController extends Controller
{
    public function index()
    {
        $halls = DB::table('halls')
            ->leftJoin('seats', 'halls.id', '=', 'seats.hall_id')
            ->select(
                'halls.id',
                'halls.name',
                DB::raw('MAX(seats.row) as rows'),
                DB::raw('MAX(seats.col) as cols')
            )
            ->groupBy('halls.id', 'halls.name')
            ->get();

        return response()->json($halls);
    }

    /**
     * Создать новый зал
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        $hall = Hall::create($validated);

        return response()->json($hall, 201);
    }

    public function show($id)
    {
        $hall = DB::table('halls')
            ->leftJoin('seats', 'halls.id', '=', 'seats.hall_id')
            ->where('halls.id', $id)
            ->select(
                'halls.id',
                'halls.name',
                DB::raw('MAX(seats.row) as rows'),
                DB::raw('MAX(seats.col) as cols')
            )
            ->groupBy('halls.id', 'halls.name')
            ->first();

        if (!$hall) {
            return response()->json(['message' => 'Hall not found'], 404);
        }

        return response()->json($hall);
    }

    public function update(Request $request, $id)
    {
        $hall = Hall::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'city_id' => 'sometimes|exists:cities,id',
        ]);

        $hall->update($validated);

        return response()->json($hall);
    }

    public function destroy($id)
    {
        $hall = Hall::findOrFail($id);
        $hall->delete();

        return response()->json(['message' => 'Hall deleted']);
    }
}
