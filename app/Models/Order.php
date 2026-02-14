<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'ticket_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(HallSession::class, 'session_id');
    }

    public function reservedSeats()
    {
        return $this->hasMany(SessionSeatReserve::class, 'order_id');
    }
}
