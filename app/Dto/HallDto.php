<?php

namespace App\Dto;

use Illuminate\Http\Request;

class HallDto
{
    public function __construct(
        public readonly string $name,
        public readonly int $cinemaId,
        public readonly int $rowNumber,
        public readonly int $seatNumber,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'cinemaId' => 'required|exists:cinemas,id',
            'rowNumber' => 'required|integer|min:1',
            'seatNumber' => 'required|integer|min:1',
        ]);

        return new self(
            name: $data['name'],
            cinemaId: $data['cinemaId'],
            rowNumber: $data['rowNumber'],
            seatNumber: $data['seatNumber'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'cinema_id' => $this->cinemaId,
            'row_number' => $this->rowNumber,
            'seat_number' => $this->seatNumber,
        ];
    }
}
