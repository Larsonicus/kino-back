<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'row',
        'col',
        'price',
        'hall_id',
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'sessions_seats_reserve')->withTimestamps();
    }
}
