<?php

// namespace App\Http\Controllers;

// use App\Models\Account;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;

// class AccountController extends Controller
// {
//     protected function index(){
//         $account=Account::all();
//         return response()->json($account,200);
//     }
//     protected function store(Request $request):void{
//         Account::create($request->all());
//     }
//     public function login(Request $request){
//         $login=[
//             'email'=>$request->input('email'),
//             'password'=>$request->input('pw')
//         ];
//         if (Auth::attempt($login)) {
//             $user = Auth::guard('account_guard')->user();
//             if ($user->verify == 1) {
//                 $token = $user->createToken('API Token')->plainTextToken;
//                 return response()->json([
//                     'message' => 'Login successfully',
//                     'token' => $token,
//                 ]);
//             } else {
//                 return response()->json([
//                     'message' => 'Account not verified',
//                 ], 401);
//             }
//         } else {
//             return response()->json([
//                 'message' => 'Invalid email or password',
//             ], 401);
//         }
//     }
//     protected function Logout(){
//         $user = Auth::user();
//         $tokenName = 'API Token'; // Replace with the desired token name
//         $user->tokens()->where('name', $tokenName)->delete();

//         // Perform any additional logout logic, if necessary

//         return response()->json(['message' => 'Logged out successfully']);
// //        Session::forget('user');
// //        Session::forget(cart);
//     }
//     protected function show($email){
//         $account = Account::where('email', $email)->first();
//         $id=$account->id;
//         return $id;
//     }
// //    protected function update(Request $request,$id){
// //        $account=Account::find($id);
// //        $account->email=$request->input('email');
// //        $account->password=$request->input('password')->bcrypt;
// //        $account->save();
// //    }
// //    protected  function destroy($id){
// //        $account=Account::find($id);
// //        $account->delete();
// //    }
//     //
// }
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
public function logout(Request $request)
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
