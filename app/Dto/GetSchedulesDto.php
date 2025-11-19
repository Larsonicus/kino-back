<?php

namespace App\Dto;

use Illuminate\Http\Request;

class GetSchedulesDto
{
    public function __construct(
        public readonly int $cityId,
        public readonly string $date,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'city' => 'required|integer|exists:cities,id',
            'date' => 'required|date_format:Y-m-d',
        ]);

        return new self(
            cityId: $validated['city'],
            date: $validated['date'],
        );
    }
}
