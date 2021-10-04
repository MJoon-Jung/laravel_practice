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
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class Auth
 *
 * @package App\Http\Controllers\AuthController
 *
 * @author  MJoon-Jung <gjgjajaj31@gmail.com>
 */
class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
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
        try {
            $user_info = Socialite::driver('google')->stateless()->user();
            // $user = Socialite::driver('facebook')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
        
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

        Auth::login($user, true);

        return redirect()->away(env('CLIENT_BASE_URL'));
    }
    /**
     *
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="로그 아웃",
     *     description="로그 아웃",
     *     @OA\Response(
     *         response=200,
     *         description="logout success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="200"),
     *             @OA\Property(property="message", type="string", example="logout success"),
     *         )
     *     ),
     *     tags={"Auth"},
     * )
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => '200',
            'message' => 'logout success',
        ], 200);
    }
}
