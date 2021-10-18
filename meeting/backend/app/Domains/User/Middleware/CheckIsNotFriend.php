<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckIsNotFriend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = (int) $request->route('id');
        $credentials = [$id, Auth::user()->id];
        $isFriend = DB::table('friends')->whereIn('user_id', $credentials)->whereIn('friend_id', $credentials)->exists();
        if ($isFriend) {
            throw new HttpException(403, '이미 친구 상태 입니다.');
        }
        return $next($request);
    }
}
