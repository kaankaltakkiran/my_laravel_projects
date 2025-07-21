<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $token = Auth::login($user);
        // $token = Auth::guard('api')->login($user);

        return response()->json([
            'message' => 'Kullanıcı başarıyla kaydedildi',
            'user' => $user,
        ]);

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //$token = Auth::attempt($credentials);
        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Email veya şifre yanlış'], 401);
        }
        //$user = Auth::user();
        $user = Auth::guard('api')->user();
        return response()->json([
            'message' => 'Giriş başarılı',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {

        Auth::guard('api')->logout();
        return response()->json(['message' => 'Çıkış başarılı.']);

    }

    public function refresh()
    {
        $user = Auth::guard('api')->user();
        $token = Auth::refresh();
        return response()->json([
            'message' => 'Yenileme başarılı',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

}
