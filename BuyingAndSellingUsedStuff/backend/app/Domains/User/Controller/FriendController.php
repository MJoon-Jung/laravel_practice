<?php

namespace App\Domains\User\Controller;

use App\Domains\User\User;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use Exception;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $friends = Friend::where('user_id', $userId)->orWhere('friend_id', $userId)->get();
        return response()->json([$friends]);
    }
    public function store(User $user)
    {
        return;
    }
    public function destroy(User $user)
    {
        $condition = [auth()->user()->id, $user->id];
        $friend = DB::table('friends')->whereIn('user_id', $condition)->whereIn('friend_id', $condition)->get();
        return response()->json([$friend]);
    }
}
