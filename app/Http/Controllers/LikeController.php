<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected function like(Request $request){
        $userId = auth('sanctum')->user()->id;//chuyen token thanh user_id
        $movie=$request->input('movie_id');
        if (!$userId) {
            return response()->json([
                'message' => 'Please log in',
            ]);
        }
        $like = Like::where('user_id', $userId)->where('movie_id', $movie)->first();
        if($like){
            return response()->json([
                'message' => 'Already liked',
            ]);
            
        }
        $like = new Like();
        $like->movie_id = intval($request->input('movie_id'));
        $like->user_id = intval($request->input('user_id'));
        $like->save();
        return response()->json([
            'message' => 'Like succesful',
            'like'=> $like,
        ]);
        
        
    }

    protected function unlike(Request $request){
        $user = $request->input('user_id');
        $movie=$request->input('movie_id');
    if (!$user) {
        return response()->json([
            'message' => 'Please log in',
        ]);
    }
    $like = Like::where('user_id', $user)->where('movie_id', $movie)->first();
    if($like){
        $like->delete();
        return response()->json([
            'message' => 'Unlike already',
        ]);
    }
    else return response()->json([
        'message' => 'Did not like yet',
    ]);
}
    protected function destroy(string $id){
        $like=Like::find($id);
        $like->delete();
    }
    protected function show(string $id){
        $num=Like::where('movie_id',$id)
        ->groupBy('movie_id')
        ->count();
        return $num;
    }
    protected function index(){
        $like=Like::all();
        return response()->json([$like],200);
    }
}