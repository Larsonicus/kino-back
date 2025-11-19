<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Resources\CinemaResource;
use App\Dto\GetCinemasDto;

class CinemaController extends Controller
{
    public function index(Request $request)
    {
        $dto = GetCinemasDto::fromRequest($request);

        $cinemas = Cinema::where('city_id', $dto->cityId)->get();

        return CinemaResource::collection($cinemas);
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
        return new CinemaResource($cinema);
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
