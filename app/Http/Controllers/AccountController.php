<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected function index(){
        $account=Account::all();
        return response()->json([
            'account' => $account
        ],200);
    }
    protected function store(Request $request):void{
        Account::create($request->all());
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
