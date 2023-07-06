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
    $userId = auth('sanctum')->user()->id;
    $movie = $request->input('movie_id');

    if (!$userId) {
        return response()->json([
            'message' => 'Please log in',
        ]);
    }

    $like = Like::where('user_id', $userId)->where('movie_id', $movie)->first();
    if ($like) {
        return response()->json([
            'message' => 'Already liked',
        ]);
    }

    $newLike = new Like();
    $newLike->movie_id = intval($request->input('movie_id'));
    $newLike->user_id = intval($request->input('user_id'));
    $newLike->save();

    // Lấy số lượt thích hiện tại của phim
    $numLikes = Like::where('movie_id', $movie)->count();

    return response()->json([
        'message' => 'Like successful',
        'like' => $newLike,
        'num_likes' => $numLikes,
    ]);
}

protected function unlike(Request $request)
{
    $user = $request->input('user_id');
    $movie = $request->input('movie_id');

    if (!$user) {
        return response()->json([
            'message' => 'Please log in',
        ]);
    }

    $like = Like::where('user_id', $user)->where('movie_id', $movie)->first();
    if ($like) {
        $like->delete();

        // Lấy số lượt thích hiện tại của phim
        $numLikes = Like::where('movie_id', $movie)->count();

        return response()->json([
            'message' => 'Unlike successful',
            'num_likes' => $numLikes,
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