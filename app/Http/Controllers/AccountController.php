<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    protected function index(){
        $account=Account::all();
        return response()->json($account,200);
    }
    protected function store(Request $request):void{
        Account::create($request->all());
    }
    public function login(Request $request){
        $login=[
            'email'=>$request->input('email'),
            'password'=>$request->input('pw')
        ];
        if (Auth::attempt($login)) {
            $user = Auth::guard('account_guard')->user();
            if ($user->verify == 1) {
                $token = $user->createToken('API Token')->plainTextToken;
                return response()->json([
                    'message' => 'Login successfully',
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'message' => 'Account not verified',
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }
    }
    protected function Logout(){
        $user = Auth::user();
        $tokenName = 'API Token'; // Replace with the desired token name
        $user->tokens()->where('name', $tokenName)->delete();

        // Perform any additional logout logic, if necessary

        return response()->json(['message' => 'Logged out successfully']);
//        Session::forget('user');
//        Session::forget(cart);
    }
//    protected function show($id){
//        $account=Account::find($id);
//        return $account;
//    }
//    protected function update(Request $request,$id){
//        $account=Account::find($id);
//        $account->email=$request->input('email');
//        $account->password=$request->input('password')->bcrypt;
//        $account->save();
//    }
//    protected  function destroy($id){
//        $account=Account::find($id);
//        $account->delete();
//    }
    //
}
