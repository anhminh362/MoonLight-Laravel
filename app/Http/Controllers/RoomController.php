<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected function index(){
        $room=Room::all();
        return $room;
    }
    public function store(Request $request):void{
        Room::create($request->all());
    }
}
