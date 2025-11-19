<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CinemaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cityId' => $this->city_id,
            'address' => $this->location,
            'lat' => $this->lat,
            'long' => $this->long,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
