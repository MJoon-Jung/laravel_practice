<?php
namespace App\Domains\User\Controller;

use App\Domains\User\Models\Friend;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/users/friends",
     *     summary="자신의 친구 정보",
     *     description="자신의 친구 정보",
     *     @OA\Response(
     *         response=200,
     *         description="자신의 친구 정보"
     *     ),
     *     tags={"Friend"},
     * )
     */
    public function index(): ?JsonResponse
    {
        $userId = Auth::user()->id;
        $friends = Friend::where('user_id', $userId)->orWhere('friend_id', $userId)->get();
        return response()->json($friends);
    }
    /**
     *
     * @OA\Post(
     *     path="/api/users/friends",
     *     summary="친구 등록",
     *     @OA\Response(
     *         response=201,
     *         description="친구 등록 성공"
     *     ),
     *     tags={"Friend"},
     * )
     */
    public function store(int $userId): ?JsonResponse
    {
        $friend = Friend::create([
            'user_id'=> Auth::user()->id,
            'friend_id' => $userId,
        ]);
        $friend->save();
        return response()->json($friend, 201);
    }
    /**
     *
     * @OA\Delete(
     *     path="/api/users/friends/{id}",
     *     summary="친구 삭제",
     *     @OA\Response(
     *         response=200,
     *         description="친구 삭제 성공"
     *     ),
     *     tags={"Friend"},
     * )
     */
    public function destroy(Request $request): ?JsonResponse
    {
        $friend = $request->friend;
        $friend->delete();
        return response()->json(["message"=> "success"], 200);
    }
}
