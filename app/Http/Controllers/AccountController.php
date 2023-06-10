<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected function index(){
        $account=Account::all();
        return $account;
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
