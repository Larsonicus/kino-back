<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'movieId' => $this->movie_id,
            'movie' => $this->movie,
            'listCinemaSchedule' => CinemaScheduleResource::collection($this->cinemaSchedules),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
