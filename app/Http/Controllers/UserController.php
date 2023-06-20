<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    protected function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json($user, 200);
    }

    protected function block($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        if ($user->status === 1) {
            $user->status = 0;
            $user->save();
            return response()->json(['message' => 'User blocked successfully'], 
            200);
        }

        return response()->json(['message' => 'Cannot block user'], 400);
    }

    protected function unblock($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        if ($user->status === 0) {
            $user->status = 1;
            $user->save();
            return response()->json(['message' => 'User unblocked successfully'], 200);
        }

        return response()->json(['message' => 'Cannot unblock user'], 400);
    }

    protected function destroy(string $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully'], 200);
}


    protected function store(Request $request)
    {
        return User::create($request->all());
    }
}


