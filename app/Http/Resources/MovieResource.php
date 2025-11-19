<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'age' => $this->age,
            'year' => $this->year,
            'genres' => $this->genres,
            'countries' => $this->countries,
            'ratingKinopoisk' => $this->rating_kinopoisk,
        ];
    }
}
