<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'date',
        'movie_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function cinemaSchedules()
    {
        return $this->hasMany(CinemaSchedule::class);
    }
}
