<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Mail\OTPMail;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    const OTP_PREFIX = 'OTP_CODE_';

    public static  function sendEmailConfirmAccount(Account $account, int $otp)
    {
        $expiredAt = Carbon::now()->addMinutes(5);
        Cache::put(self::OTP_PREFIX. $account->id, $otp, $expiredAt);

        $otpMail = new OTPMail($account,$otp);
        Mail::to($account->email)->send($otpMail);

    }

    public static function generateOtp(): int{
        return rand(100000,999999);
    }

    public  function verifyOtp(OtpRequest $otpRequest){
        $account = Account::firstWhere('email', $otpRequest->email);
        if($account['verify']){
            return $this->commonResponse($account,'Account existed','500');
        }



        if (Cache::get(self::OTP_PREFIX. $account->id) == $otpRequest->otp){
            Account::where('email', $otpRequest->email)
                ->update([
                    'verify'=>1
                ]);
            Cache::forever(self::OTP_PREFIX,$account->id);
            return $this->commonResponse($account,'verify successfully','200');
        }

        return $this->commonResponse([],'Your otp is wrong or  has been expired',401);
    }
}
