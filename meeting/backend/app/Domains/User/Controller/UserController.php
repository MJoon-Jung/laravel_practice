<?php

namespace App\Domains\User\Controller;

use App\Domains\User\Dto\CreateUserProfileDto;
use App\Domains\User\Models\User;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     *
     * @OA\Get(
     *     path="/api/users",
     *     summary="모든 유저 조회",
     *     @OA\Response(
     *         response=200,
     *         description="모든 유저 조회 성공"
     *     ),
     *     tags={"User"},
     * )
     */
    public function index(): ?JsonResponse
    {
        return response()->json($this->userService->all(), 200);
    }
    public function info(): ?JsonResponse
    {
        $id = Auth::user()->id;
        try {
            $user = User::where('id', $id)->with([
                'posts',
                'likePosts',
                'groups',
                'rooms',
            ])->get();
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundHttpException($exception->getMessage(), null, 403);
        }
        return response()->json($user, 200);
    }
    /**
     *
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="특정 유저 조회",
     *     @OA\Response(
     *         response=200,
     *         description="특정 유저 조회 성공"
     *     ),
     *     tags={"User"},
     * )
     */
    public function show(int $id): ?JsonResponse
    {
        $user = User::where('id', $id)->with(['groups', 'likePosts', 'posts', 'rooms'])->get();
        return response()->json($user, 200);
    }
    /**
     *
     * @OA\Post(
     *     path="/api/users/profile/image",
     *     summary="유저 프로필 이미지 저장",
     *     @OA\Response(
     *         response=201,
     *         description="유저 프로필 이미지 저장 성공"
     *     ),
     *     tags={"User"},
     * )
     */
    public function image(Request $request): ?JsonResponse
    {
        $request->validate([
            'image' => 'required',
        ]);

        $image = $request->file('image')->store('public');
        return response()->json($image, 201);
    }
    /**
     *
     * @OA\Patch(
     *     path="/api/users/profile",
     *     summary="유저 프로필 등록",
     *     @OA\Response(
     *         response=200,
     *         description="유저 프로필 등록 성공"
     *     ),
     *     tags={"User"},
     * )
     */
    public function updateProfile(Request $request): ?JsonResponse
    {
        $request->validate([
            'name' => 'required|max:30|min:1',
            'gender' => 'required',
        ]);

        $profile = new CreateUserProfileDto($request->name, $request->gender, $request?->image);
        return response()->json($this->userService->updateProfile(Auth::user()->id, $profile), 200);
    }
    /**
     *
     * @OA\Delete(
     *     path="/api/users",
     *     summary="유저 탈퇴",
     *     @OA\Response(
     *         response=200,
     *         description="유저 탈퇴 성공"
     *     ),
     *     tags={"User"},
     * )
     */
    public function destroy(): ?JsonResponse
    {
        return response()->json([$this->userService->destroy(Auth::user()->id)], 200);
    }
}
