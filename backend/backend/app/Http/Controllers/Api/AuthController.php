<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function register(RegisterRequest $request)
    // {
    //     $data = $request->validated();
    //     $user = User::create([
    //         'name'=>$data['name'],
    //         'email'=>$data['email'],
    //         'password'=>Hash::make($data['password']),
    //     ]);
    //     $token = $user->createToken('api-token')->plainTextToken;
    //     return response()->json(['success'=>true,'data'=>['user'=>$user,'token'=>$token]],201);
    // }

    // public function login(LoginRequest $request)
    // {
    //     $data = $request->validated();
    //     $user = User::where('email',$data['email'])->first();
    //     if (!$user || !Hash::check($data['password'],$user->password)) {
    //         return response()->json(['success'=>false,'message'=>'Email hoặc mật khẩu không đúng'],401);
    //     }
    //     $token = $user->createToken('api-token')->plainTextToken;
    //     return response()->json(['success'=>true,'data'=>['user'=>$user,'token'=>$token]]);
    // }

    // public function logout(Request $request)
    // {
    //     $user = $request->user();
    //     if ($user && $request->bearerToken()) {
    //         $user->currentAccessToken()->delete();
    //     }
    //     return response()->json(['success'=>true,'message'=>'Đã đăng xuất']);
    // }

    // public function me(Request $request)
    // {
    //     $user = $request->user();
    //     return response()->json(['success'=>true,'data'=>['user'=>$user,'subscription_level'=>$user->getCurrentSubscriptionLevel()]]);
    // }
    public function login(Request $request)
{
    // Lấy email & password từ request (form gửi lên)
    $credentials = $request->only('email', 'password');

    // Dùng Auth để kiểm tra tài khoản
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Nếu đúng -> trả về thông tin user
        return response()->json([
            'message' => 'Login thành công',
            'user' => $user
        ]);
    }

    // Nếu sai email hoặc mật khẩu
    return response()->json(['message' => 'Sai email hoặc password'], 401);
}
}
