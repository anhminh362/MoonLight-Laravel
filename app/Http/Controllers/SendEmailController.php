<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function SendMail(Request $request)
    {    
        $account = auth('sanctum')->user();
        
        if (!$account) {
            return response()->json([
                'message' => 'Please log in',
            ]);
        }
        
        $accountId = $account->id;
        $userId = User::where('account_id', $accountId)->first()->id;
        $user = User::find($userId);
        $schedule=Schedule::find($request->input('schedule_id'));
        $movieId=$schedule->movie_id;
        $toEmail =  Account::firstWhere('id',$user->account_id)->email;
        $roomId=$schedule->room_id;
        $name=$user->name;
        $movie=Movie::find($movieId)->name;
        $seats = $request->input('seats');
        $seat = implode(', ', $seats);
        $room = Room::find($roomId)->name;
        $time = $schedule->time_begin;
        $day  = $schedule->movie_date;
        $totalPrice = $request->input('price');
        Mail::send('emails.test', compact('movie','name','seat','room','time','totalPrice','day'), function($email) use($name, $toEmail, $seat,$room,$time,$totalPrice,$day,$movie ){
            $email->subject('MoonLight Cinema');
            $email->to($toEmail, $name, $seat,$room,$time,$totalPrice,$day,$movie  );
        });
    }
}
