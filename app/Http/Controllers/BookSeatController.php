<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class BookSeatController extends Controller
{
    protected function show(string $id){
        $ticket=Ticket::where('schedule_id',$id)->get();
        return response()->json($ticket, 200);
    }
}
