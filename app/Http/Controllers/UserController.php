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
}
