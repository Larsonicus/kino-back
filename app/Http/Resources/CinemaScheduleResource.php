<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CinemaScheduleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'scheduleId' => $this->schedule_id,
            'cinemaId' => $this->cinema_id,
            'cinema' => $this->cinema,
            'listHallSchedule' => HallScheduleResource::collection($this->hallSchedules),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
