<?php
namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\Request;
use App\Dto\SessionDto;
use App\Models\Schedule;
use App\Models\HallSchedule;
use App\Models\CinemaSchedule;
use App\Models\HallSession;
use App\Models\Hall;
use Carbon\Carbon;
use App\Http\Resources\SessionResource;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function __construct(
        private SessionService $sessionService
    ) {}

    public function index()
    {
        $sessions = $this->sessionService->getAllSessionsWithSeatsStatus();
        return SessionResource::collection($sessions);
    }

    public function show($id)
    {
        $session = $this->sessionService->getSessionWithSeatsStatus($id);
        return new SessionResource($session);
    }

    public function store(Request $request)
    {
        $dto = SessionDto::fromRequest($request);

        if (!$dto->startTime->isSameDay($dto->endTime)) {
            return response()->json([
                'message' => 'Сессия не может выходить за пределы одного дня.'
            ], 422);
        }

        $bufferMinutes = 5;
        $nowWithBuffer = Carbon::now()->subMinutes($bufferMinutes);

        if ($dto->startTime->lt($nowWithBuffer)) {
            return response()->json([
                'message' => 'Начальное время сессии слишком давно прошло.'
            ], 422);
        }

        return DB::transaction(function () use ($dto) {
            $schedule = Schedule::firstOrCreate([
                'date' => $dto->startTime->toDateString(),
                'movie_id' => $dto->movieId,
            ]);

            $hall = Hall::findOrFail($dto->hallId);

            $cinemaSchedule = CinemaSchedule::firstOrCreate([
                'schedule_id' => $schedule->id,
                'cinema_id' => $hall->cinema_id,
            ]);

            $hallSchedule = HallSchedule::firstOrCreate([
                'hall_id' => $dto->hallId,
                'cinema_schedule_id' => $cinemaSchedule->id,
            ]);

            $overlap = HallSession::where('hall_id', $dto->hallId)
                ->whereDate('start_time', $dto->startTime->toDateString())
                ->where(function($query) use ($dto) {
                    $query->whereBetween('start_time', [$dto->startTime, $dto->endTime])
                        ->orWhereBetween('end_time', [$dto->startTime, $dto->endTime])
                        ->orWhere(function($q) use ($dto) {
                            $q->where('start_time', '<=', $dto->startTime)
                                ->where('end_time', '>=', $dto->endTime);
                        });
                })
                ->exists();

            if ($overlap) {
                return response()->json([
                    'message' => 'В этом зале уже есть сессия в указанный промежуток времени.'
                ], 422);
            }

            $session = HallSession::create([
                'hall_schedule_id' => $hallSchedule->id,
                'hall_id' => $dto->hallId,
                'start_time' => $dto->startTime->toDateTimeString(),
                'end_time' => $dto->endTime->toDateTimeString(),
                'price' => $dto->price,
            ]);

            return new SessionResource($session);
        });
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $session = HallSession::findOrFail($id);

            $hallScheduleId = $session->hall_schedule_id;
            $cinemaScheduleId = $session->hallSchedule->cinema_schedule_id ?? null;
            $scheduleId = $session->hallSchedule->cinemaSchedule->schedule_id ?? null;

            $session->delete();

            if (!HallSession::where('hall_schedule_id', $hallScheduleId)->exists()) {
                HallSchedule::where('id', $hallScheduleId)->delete();
            }

            if ($cinemaScheduleId && !HallSchedule::where('cinema_schedule_id', $cinemaScheduleId)->exists()) {
                CinemaSchedule::where('id', $cinemaScheduleId)->delete();
            }

            if ($scheduleId && !CinemaSchedule::where('schedule_id', $scheduleId)->exists()) {
                Schedule::where('id', $scheduleId)->delete();
            }
        });

        return response()->noContent();
}
}

