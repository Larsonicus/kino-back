<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        return response()->json(Movie::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'age' => 'required|string|max:10',
            'year' => 'required|integer',
            'genres' => 'required|array',
            'countries' => 'required|array',
            'rating_kinopoisk' => 'nullable|numeric',
        ]);

        $movie = Movie::create($data);

        return response()->json($movie, 201);
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'image' => 'sometimes|string',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'age' => 'sometimes|string|max:10',
            'year' => 'sometimes|integer',
            'genres' => 'sometimes|array',
            'countries' => 'sometimes|array',
            'ratingKinopoisk' => 'nullable|numeric',
        ]);

        $movie->update($data);

        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully.']);
    }
}
