<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected function like(Request $request)
{
    $user = auth('sanctum')->user();
    
    if (!$user) {
        return response()->json([
            'message' => 'Please log in',
        ]);
    }
    
    $accountId = $user->id;
    $userId = User::where('account_id', $accountId)->first()->id;
    $movie = $request->input('movie_id');

    $like = Like::where('user_id', $userId)->where('movie_id', $movie)->first();
    if ($like) {
        return response()->json([
            'message' => 'Already liked',
        ]);
    }

    $newLike = new Like();
    $newLike->movie_id = intval($request->input('movie_id'));
    $newLike->user_id = $userId;
    $newLike->save();


    return response()->json([
        'message' => 'Like successful',
        'like' => $newLike,
    ]);
}

protected function unlike(Request $request)
{
    $user = auth('sanctum')->user();
    
    if (!$user) {
        return response()->json([
            'message' => 'Please log in',
        ]);
    }
    
    
    $accountId = $user->id;
    $userId = User::where('account_id', $accountId)->first()->id;
    $movie = $request->input('movie_id');


    $like = Like::where('user_id', $userId)->where('movie_id', $movie)->first();
    if ($like) {
        $like->delete();

        return response()->json([
            'message' => 'Unlike successful',
        ]);
    } else {
        return response()->json([
            'message' => 'Did not like yet',
        ]);
    }
}

protected function getLikesByMovieId(string $id)
{
    $num = Like::where('movie_id', $id)
        ->groupBy('movie_id')
        ->count();

    return $num;
}

protected function index()
{
    $likes = Like::all();

    return response()->json($likes, 200);
}
}