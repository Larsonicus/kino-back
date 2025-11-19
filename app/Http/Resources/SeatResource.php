<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rowNumber' => $this->row,
            'seatNumber' => $this->col,
            'price' => $this->price,
        ];
    }
}
