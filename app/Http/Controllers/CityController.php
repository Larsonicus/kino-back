<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function show($id)
    {
        $city = City::findOrFail($id);
        return $city;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        $city = City::create($validated);

        return response()->json($city, 201);
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'lat' => 'sometimes|numeric',
            'long' => 'sometimes|numeric',
        ]);

        $city->update($validated);

        return response()->json($city);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json(null, 204);
    }
}
