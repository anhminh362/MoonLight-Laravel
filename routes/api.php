<?php

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

});
Route::controller(\App\Http\Controllers\UserController::class)->group(function (){
   Route::get('users','index');
   Route::put('block/{id}','block');
   Route::put('unblock/{id}','unblock');
   Route::post('users','store');

});

Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('verify',[\App\Http\Controllers\VerificationController::class,'verifyOtp']);

Route::controller(\App\Http\Controllers\RoomController::class)->group(function (){
   Route::get('room','index');
   Route::post('room','store');
});

Route::controller(\App\Http\Controllers\CategoryController::class)->group(function (){
   Route::get('cat','index');
   Route::post('cat','store');
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

