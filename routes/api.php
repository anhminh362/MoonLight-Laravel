<?php

use App\Http\Controllers\BookSeatController;
use App\Http\Controllers\BookTicketController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(\App\Http\Controllers\AccountController::class)->group(function (){
   Route::get('account','index');
   Route::post('account','store');
   Route::get('account/{email}','show');

});
Route::controller(\App\Http\Controllers\UserController::class)->group(function (){
   Route::get('users','index');
   Route::put('block/{id}','block');
   Route::put('unblock/{id}','unblock');
   Route::post('users','store');
   Route::delete('users/{id}', 'destroy');


});

Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('verify',[\App\Http\Controllers\VerificationController::class,'verifyOtp']);



Route::post('/Login', [\App\Http\Controllers\AccountController::class, 'login']);
Route::post('/Logout', [\App\Http\Controllers\AccountController::class, 'logout']);


Route::controller(\App\Http\Controllers\RoomController::class)->group(function (){
   Route::get('room','index');
   Route::post('room','store');
});
Route::get('/check-email',[\App\Http\Controllers\AccountController::class,'checkEmail']);

Route::controller(\App\Http\Controllers\CategoryController::class)->group(function (){
   Route::get('cat','index');
   Route::post('cat','store');
   Route::get('cat/{id}','show');
});

Route::controller(\App\Http\Controllers\MovieController::class)->group(function (){
   Route::post('movie','store');
   Route::get('movie','index');
   Route::get('movie/{id}','show');
   Route::put('movie/{id}','update');
   Route::delete('movie/{id}','destroy');

});

Route::controller(\App\Http\Controllers\MovieCatController::class)->group(function (){
   Route::get('movieCat','index');
   Route::get('movieCat/{id}','show');
   Route::post('movieCat','store');
   Route::delete('movieCat/{id}','destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//====================================CRUD Schedule========================================//

Route::get('schedule',[App\Http\Controllers\ScheduleController::class,'getSchedule']);

Route::get('schedule/{id}', [App\Http\Controllers\ScheduleController::class,'getOneSchedule']);

Route::post('schedule',[App\Http\Controllers\ScheduleController::class,'addSchedule']);

Route::delete('schedule/{id}',[App\Http\Controllers\ScheduleController::class,'deleteSchedule']);

Route::put('schedule/{id}',[App\Http\Controllers\ScheduleController::class,'editSchelude']);
Route::post('scheduleId',[App\Http\Controllers\ScheduleController::class,'findScheduleId']);

//==================
Route::controller(TicketController::class)->group(function (){
   Route::post('ticket','store');
   Route::put('ticket/{id}','update');
   Route::get('ticket','index');
});

Route::controller(BookTicketController::class)->group(function(){
   Route::get('bookticket/{id}','show');
});

Route::controller(BookSeatController::class)->group(function(){
   Route::get('bookseat/{id}','show');
});

Route::controller(LikeController::class)->group(function(){
   Route::post('like','like');
   Route::get('like/{id}','show');
   Route::post('unlike','unlike');
   Route::get('like','index');
});