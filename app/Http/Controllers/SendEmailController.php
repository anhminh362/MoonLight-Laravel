<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class SendEmailController extends Controller
{
    public function SendMail()
    {
        $toEmail = 'kieu.ho24@student.passerellesnumeriques.org';
        $name='MoonLight Cinama';
        $seat = "B1 B2";
        $room = "Room 10";
        $time = "19/2";
        $totalPrice = "123";

        Mail::send('emails.test', compact('name','seat','room','time','totalPrice'), function($email) use($name, $toEmail, $seat,$room,$time,$totalPrice  ){
            $email->subject('MoonLight Cinema');
            $email->to($toEmail, $name, $seat,$room,$time,$totalPrice  );
        });
    }
}
