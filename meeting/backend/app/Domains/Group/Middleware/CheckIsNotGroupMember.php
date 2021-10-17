<?php

namespace App\Domains\Group\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckIsNotGroupMember
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
        $userId = (int) $request->route('userId');

        $isMember = DB::table('group_user')->where('group_id', $id)->where('user_id', $userId)->exists();
        if ($isMember) {
            throw new HttpException(403, "이미 그룹원입니다.");
        }
        
        return $next($request);
    }
}
