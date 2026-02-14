<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionSeatReserve extends Model
{
    use HasFactory;

    protected $table = 'sessions_seats_reserve';

    protected $fillable = [
        'session_id',
        'seat_id',
        'order_id',
    ];

    public function session()
    {
        return $this->belongsTo(HallSession::class, 'session_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }
}
