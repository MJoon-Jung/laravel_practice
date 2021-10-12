<?php

namespace App\Domains\User\Controller;

use App\Domains\User\User;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FriendController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $friends = Friend::where('user_id', $userId)->orWhere('friend_id', $userId)->get();
        return response()->json([$friends]);
    }
    public function store(int $userId)
    {
        $condition = [auth()->user()->id, $userId];
        try {
            $isFriend = DB::table('friends')->whereIn('user_id', $condition)->whereIn('friend_id', $condition)->doesntExist();
        } catch (ModelNotFoundException $exception) {
            return response()->json(["message"=>$exception->getMessage()], 404);
        }
        if (!$isFriend) {
            return response()->json(["message" => "이미 존재하는 친구입니다."]);
        }
        $friend = Friend::create([
            'user_id'=> auth()->user()->id,
            'friend_id' => $userId,
        ]);
        $friend->save();
        return response()->json([$friend], 200);
    }
    public function destroy(int $userId)
    {
        $condition = [auth()->user()->id, $userId];
        try {
            $friend = DB::table('friends')->whereIn('user_id', $condition)->whereIn('friend_id', $condition)->get();
            $friend->delete();
        } catch (NotFoundHttpException $exception) {
            return response()->json(["error"=> $exception->getMessage()], 404);
        }
        return response()->json(["message"=> "success"], 200);
    }
}
