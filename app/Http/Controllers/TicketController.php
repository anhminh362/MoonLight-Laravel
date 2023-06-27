<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected function store(Request $request){
        for($i = 0; $i<40; $i++){

            Ticket::create($request->all());
        }
    }
    protected function index(){
        $tickets=Ticket::all();
        return response()->json($tickets,200);
    }
    protected function update($id){
        $ticket=Ticket::find($id);
       $ticket->status=false;
       $ticket->save();
    }
}
