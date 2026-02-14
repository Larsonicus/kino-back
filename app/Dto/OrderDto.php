<?php

namespace App\Dto;

use Illuminate\Http\Request;

class OrderDto
{
    public int $sessionId;
    public array $seatIds;

    private function __construct(int $sessionId, array $seatIds)
    {
        $this->sessionId = $sessionId;
        $this->seatIds = $seatIds;
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'sessionId' => 'required|exists:halls_sessions,id',
            'seatIds' => 'required|array|min:1',
            'seatIds.*' => 'integer',
        ]);

        return new self(
            sessionId: $validated['sessionId'],
            seatIds: $validated['seatIds']
        );
    }
}
