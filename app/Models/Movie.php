<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'image',
        'name',
        'description',
        'age',
        'year',
        'genres',
        'countries',
        'rating_kinopoisk',
    ];

    protected $casts = [
        'genres' => 'array',
        'countries' => 'array',
        'rating_kinopoisk' => 'float',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
