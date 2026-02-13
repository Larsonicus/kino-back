<?php

namespace App\Dto;

use Illuminate\Http\Request;

class CityDto
{
    public function __construct(
        public readonly string $name,
        public readonly float $lat,
        public readonly float $long,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        return new self(
            name: $validated['name'],
            lat: $validated['latitude'],
            long: $validated['longitude'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'lat' => $this->lat,
            'long' => $this->long,
        ];
    }
}
