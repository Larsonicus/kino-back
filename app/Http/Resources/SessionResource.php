<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Seat;

class SessionResource extends JsonResource
{
    public function toArray($request)
    {
        $allSeats = Seat::where('hall_id', $this->hall_id)->get();

        $reservedSeatIds = $this->reservedSeats ? $this->reservedSeats->pluck('id')->toArray() : [];

        $seatsWithReservation = $allSeats->map(function($seat) use ($reservedSeatIds) {
            $seat->isReserved = in_array($seat->id, $reservedSeatIds);
            return $seat;
        });

        return [
            'id' => $this->id,
            'hallScheduleId' => $this->hall_schedule_id,
            'hallId' => $this->hall_id,
            'startTime' => $this->start_time,
            'endTime' => $this->end_time,
            'listSelectedSeat' => SessionSeatResource::collection($seatsWithReservation),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
