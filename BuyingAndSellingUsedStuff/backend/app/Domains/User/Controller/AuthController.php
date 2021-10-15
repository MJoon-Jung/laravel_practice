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
namespace App\Domains\User\Controller;

use App\Domains\User\Dto\GoogleOauthDto;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class Auth
 *
 * @package App\Domains\User\Controller;
 *
 * @author  MJoon-Jung <gjgjajaj31@gmail.com>
 */
class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
        try {
            $user_info = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
        $oauth = new GoogleOauthDto($user_info->getId(), $user_info->getEmail(), $user_info->getName(), isset($user_info->user["hd"]) ? $user_info->user["hd"] : null);

        try {
            $user = $this->userService->firstOrCreateByGsuitHd($oauth);
        } catch (BadRequestHttpException $e) {
            //에러 화면과 되돌아가기 화면을 제공해줘야 함
            //hd가 다르면 오류가 나오는 데 사용자는 그걸 모를 수 있음
            return response()->json(['status' => 402, 'message' => $e->getMessage()]);
            // return redirect()->route('login');
        }

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
