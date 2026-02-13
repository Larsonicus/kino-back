<?php

namespace App\Dto;

use Illuminate\Http\Request;

class CinemaDto
{
    public function __construct(
        public readonly string $address,
        public readonly int $cityId,
        public readonly float $lat,
        public readonly float $long,
        public readonly string $contactNumber,
        public readonly string $name,
        public readonly string $workingHours,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $data = $request->validate([
            'city' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contactNumber' => 'required|regex:/^\+?[0-9\s\-\(\)]+$/|max:20',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i',
            'name' => 'required|string|max:255',
        ]);

        $workingHours = $data['startTime'] . ' - ' . $data['endTime'];

        return new self(
            address: $data['address'],
            cityId: $data['city'],
            lat: $data['latitude'],
            long: $data['longitude'],
            contactNumber: $data['contactNumber'],
            workingHours: $workingHours,
            name: $data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'address' => $this->address,
            'city_id' => $this->cityId,
            'lat' => $this->lat,
            'long' => $this->long,
            'contact_number' => $this->contactNumber,
            'working_hours' => $this->workingHours,
            'name' => $this->name,
        ];
    }
}
