<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

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
}
