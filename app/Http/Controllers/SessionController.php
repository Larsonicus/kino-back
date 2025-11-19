<?php
namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct(
        private SessionService $sessionService
    ) {}

    public function index()
    {
        $sessions = $this->sessionService->getAllSessionsWithSeatsStatus();
        return response()->json($sessions);
    }

    public function show($id)
    {
        $session = $this->sessionService->getSessionWithSeatsStatus($id);
        return response()->json($session);
    }

    public function reserveSeats(Request $request, $id)
    {
        $validated = $request->validate([
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'integer|exists:seats,id',
        ]);

        $this->sessionService->reserveSeats($id, $validated['seat_ids']);

        return response()->json(['message' => 'Места успешно забронированы']);
    }
}
