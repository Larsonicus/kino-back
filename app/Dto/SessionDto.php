<?php

namespace App\Dto;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SessionDto
{
    public function __construct(
        public readonly Carbon $startTime,
        public readonly Carbon $endTime,
        public readonly int $hallId,
        public readonly int $movieId,
        public readonly int $price = 500,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $data = $request->validate([
            'startTime' => 'required|date',
            'endTime'   => 'required|date|after:startTime',
            'hallId'    => 'required|integer|exists:halls,id',
            'movieId'   => 'required|integer|exists:movies,id',
            'price'     => 'nullable|integer|min:0',
        ]);

        return new self(
            startTime: Carbon::parse($data['startTime']),
            endTime: Carbon::parse($data['endTime']),
            hallId: $data['hallId'],
            movieId: $data['movieId'],
            price: $data['price'] ?? 500,
        );
    }
}
