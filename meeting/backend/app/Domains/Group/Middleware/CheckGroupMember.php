<?php

namespace App\Domains\Group\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckGroupMember
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
        $id = $request->route('id');
        $isNotMember = DB::table('group_user')->where('group_id', $id)->where('user_id', Auth::user()->id)->doesntExist();
        if ($isNotMember) {
            throw new HttpException(403, "그룹원이 아닙니다.");
        }
        return $next($request);
    }
}
