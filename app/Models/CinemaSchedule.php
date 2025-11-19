<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinemaSchedule extends Model
{
    protected $fillable = [
        'schedule_id',
        'cinema_id'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function hallSchedules()
    {
        return $this->hasMany(HallSchedule::class);
    }
}
