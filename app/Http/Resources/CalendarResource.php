<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    public function toArray($request): array
    {
        $date = $this->date;
        $sessions = $this->sessions_by_date;

        if ($sessions->isEmpty()) {
            return [
                'date' => $date,
                'isSelected' => false,
            ];
        }

        $allSeatsOccupied = $sessions->every(fn($s) => $s->free_seats_count === 0);

        return [
            'date' => $date,
            'isSelected' => !$allSeatsOccupied,
        ];
    }
}
