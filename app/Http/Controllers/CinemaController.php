<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::all();
        return response()->json($cinemas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
        ]);

        $cinema = Cinema::create($validated);

        return response()->json($cinema, 201);
    }

    public function show($id)
    {
        $cinema = Cinema::findOrFail($id);
        return response()->json($cinema);
    }

    public function update(Request $request, $id)
    {
        $cinema = Cinema::findOrFail($id);

        $validated = $request->validate([
            'city_id' => 'sometimes|exists:cities,id',
            'address' => 'sometimes|string|max:255',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
        ]);

        $cinema->update($validated);

        return response()->json($cinema);
    }

    public function destroy($id)
    {
        $cinema = Cinema::findOrFail($id);
        $cinema->delete();

        return response()->json(['message' => 'Cinema deleted']);
    }
}
