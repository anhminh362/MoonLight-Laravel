<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

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
        $response = [];

        foreach ($schedule as $date => $times) {
            $response[] = ["movie_date" => $date, "times" => $times->toArray()];
        }
    
        return response()->json($response, 200);
    }
}
