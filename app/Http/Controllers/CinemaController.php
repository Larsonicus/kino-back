<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Resources\CinemaResource;
use App\Dto\GetCinemasDto;
use App\Dto\CinemaDto;
use App\Dto\PartialCinemaDto;

class CinemaController extends Controller
{
    public function index(Request $request)
    {
        $dto = GetCinemasDto::fromRequest($request);

        if ($dto->cityId !== null) {
            $cinemas = Cinema::where('city_id', $dto->cityId)->get();
            return CinemaResource::collection($cinemas);
        }

        return CinemaResource::collection(Cinema::all());
    }

        public function show($id)
    {
        $cinema = Cinema::findOrFail($id);
        return new CinemaResource($cinema);
    }

    public function store(Request $request)
    {
        $dto = CinemaDto::fromRequest($request);

        $cinema = Cinema::create($dto->toArray());

        return new CinemaResource($cinema);
    }

    public function update(Request $request, $id)
    {
        $cinema = Cinema::findOrFail($id);

        $dto = PartialCinemaDto::fromRequest($request);

        $cinema->update($dto->toArray());

        return new CinemaResource($cinema);
    }

    public function destroy($id)
    {
        $cinema = Cinema::findOrFail($id);
        $cinema->delete();

        return response()->noContent();
    }
}
