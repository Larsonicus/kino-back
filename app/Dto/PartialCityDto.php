<?php

namespace App\Dto;

use Illuminate\Http\Request;

class PartialCityDto
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?float $lat,
        public readonly ?float $long,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
        ]);

        return new self(
            name: $validated['name'] ?? null,
            lat: $validated['latitude'] ?? null,
            long: $validated['longitude'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'lat'  => $this->lat,
            'long' => $this->long,
        ], static fn ($v) => $v !== null);
    }
}
