<?php

namespace App\Dto;

use Illuminate\Http\Request;

class GetHallsDto
{
    public function __construct(
        public readonly ?int $cinemaId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'cinema' => 'sometimes|integer|exists:cinemas,id',
        ]);

        return new self(
            cinemaId: $validated['cinema'] ?? null,
        );
    }
}
