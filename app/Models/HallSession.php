<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallSession extends Model
{
    protected $table = 'halls_sessions';

    protected $fillable = [
        'hall_schedule_id',
        'hall_id',
        'start_time',
        'end_time',
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
    ];

    public function hallSchedule()
    {
        return $this->belongsTo(HallSchedule::class, 'hall_schedule_id');
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
}
