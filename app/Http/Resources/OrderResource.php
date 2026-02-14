<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MovieResource;
use App\Http\Resources\HallResource;
use App\Http\Resources\SessionResource;
use App\Http\Resources\SessionSeatResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'ticketNumber' => (string) $this->id,

            'movie' => $this->when($this->session && $this->session->hallSchedule && $this->session->hallSchedule->cinemaSchedule && $this->session->hallSchedule->cinemaSchedule->schedule, function () {
                return new MovieResource($this->session->hallSchedule->cinemaSchedule->schedule);
            }),

            'hall' => $this->when($this->session && $this->session->hall, function () {
                return new HallResource($this->session->hall);
            }),

            'session' => $this->when($this->session, function () {
                return new SessionResource($this->session);
            }),

            'listSeat' => $this->reservedSeats->map(function($reserve) {
                $seat = $reserve->seat;
                return [
                    'id' => $seat?->id,
                    'rowNumber' => $seat?->row,
                    'seatNumber' => $seat?->col,
                    'price' => $seat?->price,
                    'isReserved' => true,
                ];
            }),
        ];
    }
}
