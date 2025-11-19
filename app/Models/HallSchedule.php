<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallSchedule extends Model
{
    protected $fillable = [
        'hall_id',
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
}
