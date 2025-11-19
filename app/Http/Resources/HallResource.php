<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cinemaId' => $this->cinema_id,
            'rowNumber' => $this->seats()->max('row') ?? 0,
            'seatNumber' => $this->seats()->max('col') ?? 0,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
