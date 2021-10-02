<?php

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="BuyingAndSellingUsedStuff project",
 *      description="laravel project 2학기 과제",
 *      @OA\Contact(
 *          email="gjgjajaj31@gmail.com"
 *      ),
 * )
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Auth
 *
 * @package App\Http\Controllers\AuthController
 *
 * @author  MJoon-Jung <gjgjajaj31@gmail.com>
 */

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['redirectToProvider', 'handleProviderCallback']]);
    }
    /**
     *
     * @OA\Get(
     *     path="/api/auth/login",
     *     summary="구글 로그인",
     *     description="oauth2 callback을 넘겨주는 통로",
     *     @OA\Response(
     *         response=302,
     *         description="구글 로그인 "
     *     ),
     *     tags={"Auth"},
     * )
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     *
     * @OA\Get(
     *     path="/api/auth/login/callback",
     *     summary="구글 로그인",
     *     description="oauth2 callback",
     *     @OA\Response(
     *         response=302,
     *         description="구글 로그인 "
     *     ),
     *     tags={"Auth"},
     * )
     */
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

        // JWTAuth::setToken($refreshToken);
        // $aa = JWTAuth::getPayload($token)->toArray();
        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);
        dd($jwtPayload->exp);
        Cookie::queue('jwt.decrypt_cookies', $token, env('JWT_REFRESH_TTL', 20160));

        return redirect()->away('http://localhost:3060/refresh');
    }
    protected function respondWithRefreshToken()
    {
        $refreshToken = Auth::refresh();

        // env('JWT_REFRESH_TTL', 20160)
        Cookie::queue('refresh token', $refreshToken, $days=14);
        return response()
            // ->json(['success' => 'login success'], 200)
            ->withCookie(cookie('refresh token', $refreshToken, $days=14));
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
    public function refreshByAccessToken()
    {
        return $this->respondWithToken(Auth::refresh());
    }
    public function refreshByRefreshToken(Request $request)
    {
        $refresh_token = $request->cookie('refresh token');
        dd($refresh_token);
        
        return $this->respondWithToken(Auth::refresh());
    }
    public function me(Request $request)
    {
        return $this->refreshByRefreshToken($request);
    }
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
