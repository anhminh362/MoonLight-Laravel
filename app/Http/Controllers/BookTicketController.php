<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class BookTicketController extends Controller
{
    protected function show(string $id)
    {
        $schedule = Schedule::select('movie_date', 'time_begin')
        ->where('movie_id', $id)
        ->distinct()
        ->get()
        ->groupBy('movie_date')
        ->map(function ($item) {
            return $item->pluck('time_begin');
        });
        return response()->json($schedule, 200);
    }
}
