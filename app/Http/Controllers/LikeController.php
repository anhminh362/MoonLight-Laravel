<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Ticket;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected function like(Request $request){
            $user = $request->input('user_id');
            $movie=$request->input('movie_id');
        if (!$user) {
            return response()->json([
                'message' => 'Please log in',
            ]);
        }
        $like = Like::where('user_id', $user)->where('movie_id', $movie)->first();
        if($like){
            return response()->json([
                'message' => 'Already liked',
            ]);
            //$like->delete()
        }
        Like::create($request->all());
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
}
