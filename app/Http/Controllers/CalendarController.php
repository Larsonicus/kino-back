<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Resources\CalendarResource;

class CalendarController extends Controller
{
    public function index()
    {
        $cinemas = Schedule::whereDate('date', '>=', now())->get();
        // где есть свободные места

        return CalendarResource::collection($cinemas);
    }
}
