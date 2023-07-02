<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ScheduleController extends Controller
{
    public function getSchedule()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }
    public function getOneSchedule($id)
    {
        $schedule = Schedule::find($id);
        return response()->json($schedule);
    }
    public function addSchedule(Request $request)
    {
        $schedule = new Schedule();
        $schedule->movie_id = intval($request->input('movie_id'));
        $schedule->room_id = intval($request->input('room_id'));
        $schedule->time_begin = $request->input('time_begin');
        $schedule->time_end = $request->input('time_end');
        $schedule->movie_date = $request->input('movie_date');
        $schedule->price = intval($request->input('price'));
        $schedule->save();
        return $schedule;
    }
    public function deleteSchedule($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();

        return ['status' => 'ok', 'msg' => 'Delete successed'];	
    }
    public function editSchelude(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        $schedule->movie_id = intval($request->input('movie_id'));
        $schedule->room_id = intval($request->input('room_id'));
        $schedule->time_begin = $request->input('time_begin');
        $schedule->time_end = $request->input('time_end');
        $schedule->movie_date = $request->input('movie_date');
        $schedule->price = intval($request->input('price'));

        $schedule->save();
        return response()->json(['status' => 'ok', 'msg' => 'Edit successed']);

    }
    public function findScheduleId(Request $request){
        $movie_id = intval($request->input('movie_id'));
        $time_begin = $request->input('time_begin');
        $movie_date = $request->input('movie_date');
    
        $schedule = Schedule::select('id')
            ->where('movie_id', $movie_id)
            ->where('time_begin', $time_begin)
            ->where('movie_date', $movie_date)
            ->first();
    
        if ($schedule) {
            return response()->json(['id' => $schedule->id], 200);
        } else {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    }
}
