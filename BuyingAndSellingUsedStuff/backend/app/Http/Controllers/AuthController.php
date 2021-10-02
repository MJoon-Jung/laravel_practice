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
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['redirectToProvider', 'handleProviderCallback']]);
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
        return Socialite::driver('google')->redirect();
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
        $user_info = Socialite::driver('google')->user();
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

        return redirect()->away('http://localhost:3060');
    }
    public function me()
    {
        return auth()->user();
    }
}
