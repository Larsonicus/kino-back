<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\HallResource;
use App\Dto\HallDto;
use App\Dto\PartialHallDto;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::all();

        return HallResource::collection($halls);
    }

    public function show($id)
    {
        $hall = Hall::find($id);

        if (!$hall) {
            return response()->json(['message' => 'Hall not found'], 404);
        }

        return new HallResource($hall);
    }

    public function store(Request $request)
    {
        $dto = HallDto::fromRequest($request);


        $seats = [];
        for ($row = 1; $row <= $dto->rowNumber; $row++) {
            for ($col = 1; $col <= $dto->seatNumber; $col++) {
                $seats[] = [
                    'row' => $row,
                    'col' => $col,
                    'price' => rand(500, 2500),
                ];
            }
        }

        $hall = Hall::create($dto->toArray());
        $hall->seats()->createMany($seats);

        return new HallResource($hall);;
    }

    public function update(Request $request, int $id)
    {
        $hall = Hall::findOrFail($id);

        $dto = PartialHallDto::fromRequest($request);

        $hall->update($dto->toArray());

        $currentRows = $hall->rowNumber;
        $currentCols = $hall->seatNumber;

        $newRows = $dto->rowNumber ?? $currentRows;
        $newCols = $dto->seatNumber ?? $currentCols;

        if ($newRows > $currentRows || $newCols > $currentCols) {
            $newSeats = [];

            for ($row = 1; $row <= $newRows; $row++) {
                for ($col = 1; $col <= $newCols; $col++) {
                    if (!$hall->seats()->where(['row' => $row, 'col' => $col])->exists()) {
                        $newSeats[] = [
                            'row' => $row,
                            'col' => $col,
                            'price' => rand(500, 2500),
                        ];
                    }
                }
            }

            if (!empty($newSeats)) {
                $hall->seats()->createMany($newSeats);
            }
        }

        return new HallResource($hall);
    }


    public function destroy($id)
    {
        $hall = Hall::findOrFail($id);
        $hall->delete();

        return response()->noContent();
    }
}
