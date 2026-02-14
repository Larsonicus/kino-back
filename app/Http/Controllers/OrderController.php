<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\HallSession;
use App\Dto\OrderDto;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with([
            'session.hallSchedule.cinemaSchedule.schedule.movie',
            'session.hallSchedule.cinemaSchedule.cinema',
            'session.hall',
            'reservedSeats.seat'
        ])
        ->where('user_id', $user->id)
        ->get();

        return OrderResource::collection($orders);
    }

    public function store(Request $request)
    {
        $data = OrderDto::fromRequest($request);
        $user = Auth::user();

        $hallSession = HallSession::with([
            'hallSchedule.cinemaSchedule.schedule',
            'hallSchedule.cinemaSchedule.cinema',
            'hall',
            'reservedSeats.seat'
        ])->find($data->sessionId);

        $sessionStart = Carbon::parse(
            $hallSession->hallSchedule->cinemaSchedule->date . ' ' . $hallSession->start_time
        );

        if ($sessionStart->lt(now())) {
            return response()->json([
                'message' => 'Нельзя купить места на прошедший сеанс'
            ], 422);
        }

        $alreadyReserved = $hallSession->reservedSeats()
            ->whereIn('seat_id', $data->seatIds)
            ->exists();

        if ($alreadyReserved) {
            return response()->json([
                'message' => 'Некоторые места уже забронированы'
            ], 422);
        }

        $order = DB::transaction(function() use ($user, $hallSession, $data) {
            $order = Order::create([
                'user_id' => $user->id,
                'session_id' => $hallSession->id
            ]);

            foreach ($data->seatIds as $seatId) {
                $seat = $hallSession->hall->seats()->find($seatId);

                if (!$seat) {
                    throw new \Exception("Место с ID $seatId не найдено в зале");
                }

                $hallSession->reservedSeats()->create([
                    'order_id' => $order->id,
                    'seat_id' => $seatId
                ]);
            }

            return $order;
        });

        $order->load([
            'session.hallSchedule.cinemaSchedule.schedule.movie',
            'session.hallSchedule.cinemaSchedule.cinema',
            'session.hall',
            'reservedSeats.seat'
        ]);

        return new OrderResource($order);
    }
}
