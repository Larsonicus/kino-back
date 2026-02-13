<?php

namespace App\Dto;

use Illuminate\Http\Request;

class PartialCinemaDto
{
    public function __construct(
        public readonly ?string $address,
        public readonly ?int $cityId,
        public readonly ?float $lat,
        public readonly ?float $long,
        public readonly ?string $contactNumber,
        public readonly ?string $name,
        public readonly ?string $workingHours,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $data = $request->validate([
            'city' => 'sometimes|exists:cities,id',
            'address' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'contactNumber' => ['sometimes', 'regex:/^\+?[0-9\s\-\(\)]+$/', 'max:20'],
            'startTime' => 'sometimes|date_format:H:i',
            'endTime' => 'sometimes|date_format:H:i',
            'name' => 'sometimes|string|max:255',
        ]);

        $workingHours ;
        if (isset($data['startTime'], $data['endTime'])) {
            $workingHours = $data['startTime'] . ' - ' . $data['endTime'];
        }

        return new self(
            address: $data['address'] ?? null,
            cityId: $data['city'] ?? null,
            lat: isset($data['latitude']) ? $data['latitude'] : null,
            long: isset($data['longitude']) ? $data['longitude'] : null,
            contactNumber: $data['contactNumber'] ?? null,
            workingHours: $workingHours,
            name: $data['name'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'address' => $this->address,
            'city_id' => $this->cityId,
            'lat' => $this->lat,
            'long' => $this->long,
            'contact_number' => $this->contactNumber,
            'working_hours' => $this->workingHours,
            'name' => $this->name,
        ], fn($value) => $value !== null);
    }
}
