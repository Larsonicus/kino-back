<?php

namespace App\Dto;

use Illuminate\Http\Request;

class GetCalendarDto
{
    public function __construct(
        public readonly int $cityId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'city' => 'required|integer|exists:cities,id',
        ]);

        return new self(
            cityId: $validated['city'],
        );
    }
}
