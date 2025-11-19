<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallSchedule extends Model
{
    protected $fillable = [
        'hall_id',
        'cinema_schedule_id'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    public function cinemaSchedule()
    {
        return $this->belongsTo(CinemaSchedule::class, 'cinema_schedule_id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'hall_schedule_id');
    }
}
