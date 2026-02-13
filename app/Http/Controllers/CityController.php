<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Dto\CityDto;
use App\Dto\PartialCityDto;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    public function index()
    {
        $all = City::all();

        return CityResource::collection($all);
    }

    public function show(string $id)
    {
        $city = City::findOrFail($id);

        return new CityResource($city);
    }

    public function store(Request $request)
    {
        $dto = CityDto::fromRequest($request);

        $city = City::create($dto->toArray());

        return new CityResource($city);
    }

    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $dto = PartialCityDto::fromRequest($request);

        $city->update($dto->toArray());

        return new CityResource($city);
    }

    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->noContent();
    }
}
