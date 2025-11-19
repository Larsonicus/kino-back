<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CinemaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            // name
            // workingHours
            'cityId' => $this->city_id,
            'city' => $this->city->name,
            'address' => $this->address,
            'latitude' => $this->lat,
            'longitude' => $this->long,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
