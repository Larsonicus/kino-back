<?php

namespace App\Dto;

use Illuminate\Http\Request;

class GetCinemasDto
{
    public function __construct(
        public readonly ?int $cityId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'city' => 'sometimes|integer|exists:cities,id',
        ]);

        return new self(
            cityId: $validated['city'] ?? null,
        );
    }
}
