<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () use ($request) {
            $groupId = DB::table('groups')->insertGetId(['name'=> $request->name]);
            DB::table('group_user')->insert(
                ['group_id' => $groupId, 'user_id' => Auth::user()->id, 'group_admin' => 1]
            );
        });
        return "success";
    }
    public function update(int $groupId, Request $request)
    {
    }
}
