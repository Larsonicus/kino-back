<?php
namespace App\Services;

use App\Models\Session;
use App\Models\Seat;

class SessionService
{
    public function getSessionWithSeatsStatus(int $sessionId)
    {
        return Session::with('reservedSeats')->findOrFail($sessionId);
    }


    public function getAllSessionsWithSeatsStatus()
    {
        return Session::with('reservedSeats')->get();
    }
}
