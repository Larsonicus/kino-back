<?php
namespace App\Services;

use App\Models\Session;
use App\Models\Seat;

class SessionService
{
    public function getSessionWithSeatsStatus(int $sessionId): array
    {
        $session = Session::with('reservedSeats')->findOrFail($sessionId);

        return $this->formatSessionWithSeats($session);
    }

    public function getAllSessionsWithSeatsStatus()
    {
        $sessions = Session::with('reservedSeats')->get();

        return $sessions->map(fn($session) => $this->formatSessionWithSeats($session));
    }

    private function formatSessionWithSeats(Session $session): array
    {
        $allSeats = Seat::where('hall_id', $session->hall_id)->get();
        $bookedSeatIds = $session->reservedSeats->pluck('id')->toArray();

        $seatsStatus = $allSeats->map(function($seat) use ($bookedSeatIds) {
            return [
                'id' => $seat->id,
                'row' => $seat->row,
                'col' => $seat->col,
                'reserved' => in_array($seat->id, $bookedSeatIds),
            ];
        });

        return [
            'id' => $session->id,
            'hall_schedule_id' => $session->hall_schedule_id,
            'hall_id' => $session->hall_id,
            'start_time' => $session->start_time,
            'end_time' => $session->end_time,
            'seats' => $seatsStatus,
        ];
    }
}
