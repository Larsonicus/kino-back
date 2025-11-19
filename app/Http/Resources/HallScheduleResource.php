<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallScheduleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cinemaScheduleId' => $this->cinema_schedule_id,
            'hallId' => $this->hall_id,
            'hall' => new HallResource($this->hall),
            'sessions' => SessionResource::collection($this->sessions),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
