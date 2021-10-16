<?php

namespace App\Domains\Group\Controller;

use App\Domains\Group\Models\Group;
use App\Domains\Group\Models\GroupUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GroupController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/groups",
     *     summary="유저가 가입한 그룹들 조회",
     *     @OA\Response(
     *         response=200,
     *         description="유저가 가입한 그룹들 조회 성공"
     *     ),
     *     tags={"GROUPS"},
     * )
     */
    public function index(): ?JsonResponse
    {
        $groups = Group::whereIn('groups.id', function ($query) {
            $query
                ->select('group_id')
                ->from('group_user')
                ->where('user_id', Auth::user()->id);
        })->with('user')->get();
        return response()->json($groups, 200);
    }
    /**
     *
     * @OA\Get(
     *     path="/api/groups/{id}",
     *     summary="유저가 가입한 특정 그룹 조회",
     *     @OA\Response(
     *         response=200,
     *         description="유저가 가입한 특정 그룹 조회 성공"
     *     ),
     *     tags={"GROUPS"},
     * )
     */
    public function show(int $groupId): ?JsonResponse
    {
        $group = Group::where('id', $groupId)->with('users')->get();
        return response()->json($group, 200);
    }
    /**
     *
     * @OA\Post(
     *     path="/api/groups",
     *     summary="그룹 생성",
     *     @OA\Response(
     *         response=201,
     *         description="그룹 생성 성공"
     *     ),
     *     tags={"GROUPS"},
     * )
     */
    public function store(Request $request): ?JsonResponse
    {
        $request->validate([
            'name' => 'required|max:50|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $group = new Group(["name" => $request->name]);
            $group->save();

            $groupUser = new GroupUser([
                "group_id" => $group->id,
                "user_id" => Auth::user()->id,
                "group_admin" => 1,
            ]);
            $groupUser->save();
        });
        return response()->json(["message" => "create group success"]);
    }
    /**
     *
     * @OA\Patch(
     *     path="/api/groups/{id}",
     *     summary="그룹 정보 수정",
     *     @OA\Response(
     *         response=200,
     *         description="그룹 정보 수정 성공"
     *     ),
     *     tags={"GROUPS"},
     * )
     */
    public function update(Group $group, Request $request): ?JsonResponse
    {
        $request->validate([
            'name' => 'required|max:50|min:1',
        ]);

        $member = GroupUser::where('group_id', $group->id)->where('user_id', Auth::user()->id)->get();
        if (!$member[0]->group_admin) {
            throw new HttpException(403, '그룹장이 아닙니다.');
        }

        $group->name = $request->name;
        $group->save();

        return response()->json(["message" => "group name update success"], 200);
    }
    /**
     *
     * @OA\Delete(
     *     path="/api/groups/{id}",
     *     summary="그룹 삭제",
     *     @OA\Response(
     *         response=200,
     *         description="그룹 삭제 성공"
     *     ),
     *     tags={"GROUPS"},
     * )
     */
    public function destroy(Group $group): ?JsonResponse
    {
        $member = GroupUser::where('group_id', $group->id)->where('user_id', Auth::user()->id)->get();
        if (!$member[0]->group_admin) {
            throw new HttpException(403, '그룹장이 아닙니다.');
        }
        $group->delete();
        return response()->json(["message" => "success"]);
    }
}
