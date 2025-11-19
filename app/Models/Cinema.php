<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = [
        'city_id',
        'address',
        'lat',
        'long',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function halls()
    {
        return $this->hasMany(Hall::class);
    }

    public function cinemaSchedules()
    {
        return $this->hasMany(CinemaSchedules::class);
    }
}
