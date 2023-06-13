<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function index(){
        $user=User::all();
        return $user;
    }
    protected function show(string $id){
        $user = User::find($id);

        if (!$user){
            return response()->json([
                'message' => 'user not found',
            ],404);
        }
        return response()->json([
            'user'=>$user
        ],200);
    }
    protected function block($id){
        $user=User::find($id);
        if($user->status===1){
            $user->status=0;
            $user->save();
            return ['block successfully'];
        }
        return ['cannot block'];
    }
    protected function unblock($id): array
    {
        $user=User::find($id);
        if($user->status===0){
            $user->status=1;
            $user->save();
            return ['unblock successfully'];
        }
        return ['cannot unblock'];
    }
    protected function store(Request $request){
        return User::create($request->all());
    }
}
