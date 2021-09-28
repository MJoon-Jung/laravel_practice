<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['redirectToProvider', 'handleProviderCallback']]);
    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        $user_info = Socialite::driver('google')->stateless()->user();
        $user_profile = $user_info->user;

        if (empty($user_profile["hd"]) || $user_profile["hd"] != env('GOOGLE_HD')) {
            return response()->json([
                'status' => '403 Forbidden',
                'messages' => '영진전문대 gsuit 계정이 아닙니다.'
            ], 403);
        }
        
        $user = User::firstOrCreate(
            ['id'=>$user_info->getId()],
            ['email'=>$user_info->getEmail(),
            'name' =>$user_info->getName(),
            'password'=> bcrypt($user_info->getId())],
        );

        $credentials = ['email'=>$user-> email, 'password'=>$user->id];

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }
}
