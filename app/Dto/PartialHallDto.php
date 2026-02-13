<?php

namespace App\Dto;

use Illuminate\Http\Request;

class PartialHallDto
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?int $cinemaId,
        public readonly ?int $rowNumber,
        public readonly ?int $seatNumber,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'cinemaId' => 'sometimes|exists:cinemas,id',
            'rowNumber' => 'sometimes|integer|min:1',
            'seatNumber' => 'sometimes|integer|min:1',
        ]);

        return new self(
            name: $data['name'] ?? null,
            cinemaId: $data['cinemaId'] ?? null,
            rowNumber: $data['rowNumber'] ?? null,
            seatNumber: $data['seatNumber'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'cinema_id' => $this->cinemaId,
            'row_number' => $this->rowNumber,
            'seat_number' => $this->seatNumber,
        ], fn($value) => $value !== null);
    }
}
