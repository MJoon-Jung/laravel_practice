<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::whereIn('groups.id', function ($query) {
            $query
                ->select('group_id')
                ->from('group_user')
                ->where('user_id', Auth::user()->id);
        })->with('user')->get();
        return response()->json($groups, 200);
    }
    public function show(int $groupId)
    {
        $group = Group::where('id', $groupId)->with('users')->get();
        return response()->json($group, 200);
    }
    public function store(Request $request)
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
    public function update(Group $group, Request $request)
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

        return response(["message" => "group name update success"]);
    }
    public function destroy(Group $group)
    {
        $member = GroupUser::where('group_id', $group->id)->where('user_id', Auth::user()->id)->get();
        if (!$member[0]->group_admin) {
            throw new HttpException(403, '그룹장이 아닙니다.');
        }
        $group->delete();
        return response(["message" => "success"]);
    }
}
