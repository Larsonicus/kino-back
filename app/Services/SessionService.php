<?php
namespace App\Services;

use App\Models\HallSession;
use App\Models\Seat;

class SessionService
{
    public function getSessionWithSeatsStatus(int $sessionId)
    {
        return HallSession::with('reservedSeats')->findOrFail($sessionId);
    }


    public function getAllSessionsWithSeatsStatus()
    {
        return HallSession::with('reservedSeats')->get();
    }
}
