<?php

namespace App\Http\Controllers;

// use App\Models\Account;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Lấy danh sách tất cả các tài khoản.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $accounts = Account::all();

        return response()->json($accounts, 200);
    }

    /**
     * Tạo một tài khoản mới.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
{
    $account = new Account();
    $account->email = $request->input('email');
    $account->password = Hash::make($request->input('password'));
    $account->save();

    return response()->json([
        'message' => 'Account created successfully',
        'account' => $account,
    ], 201);
}

/**
 * Đăng nhập với email và mật khẩu.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $account = Account::where('email', $email)->first();

    if (!$account || !Hash::check($password, $account->password)) {
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }

    $token = $account->createToken('API Token')->plainTextToken;
    return response()->json([
        'message' => 'Login successfully',
        'token' => $token,
    ]);
}


/**
 * Đăng xuất.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function Logout(Request $request)
{
    $account = $request->user();
    $account->tokens()->delete();

    return response()->json([
        'message' => 'Logged out successfully',
    ]);
}

    /**
     * Hiển thị thông tin của tài khoản dựa trên email.
     *
     * @param  string  $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($email)
    {
        $account = Account::where('email', $email)->first();

        if (!$account) {
            return response()->json([
                'message' => 'Account not found',
            ], 404);
        }

        return response()->json([
            'id' => $account->id,
            'email' => $account->email,
        ]);
    }
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
    
        $account = Account::where('email', $email)->first();
    
        return response()->json([
            'exists' => $account ? true : false,
        ]);
    }
    

}
// http_proxy
// php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"