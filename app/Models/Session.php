<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'halls_sessions';

    protected $fillable = ['hall_schedule_id', 'hall_id', 'start_time', 'end_time'];

    public function reservedSeats()
    {
        return $this->belongsToMany(Seat::class, 'sessions_seats_reserve')
                    ->withTimestamps();
    }
}
