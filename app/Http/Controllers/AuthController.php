<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest){
       $registerRequest ->validate([
            'email'=>'required|email|unique:accounts',
            'password'=>'required|min:8',
            'c_password'=>'required|same:password'
            ],
            [
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'The email address is already taken.',
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least 8 characters.',
                'c_password.required' => 'The confirm password field is required.',
                'c_password.same' => 'The confirm password does not match the password.'
            ]);
        $account = new Account([
            'email'=> $registerRequest->email,
            'password'=> Hash::make($registerRequest->password),
        ]);

        $account->save();

        VerificationController::sendEmailConfirmAccount($account, VerificationController::generateOtp());

        return $this->commonResponse($account,'sent otp');

    }
}
