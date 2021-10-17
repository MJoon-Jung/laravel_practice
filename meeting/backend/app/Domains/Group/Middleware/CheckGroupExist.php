<?php

namespace App\Domains\Group\Middleware;

use App\Domains\Group\Models\Group;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckGroupExist
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
        try {
            $group = Group::where('id', $id)->get();
            $request->group = $group;
        } catch (ModelNotFoundException $exception) {
            throw new HttpException(404, "그룹이 존재하지 않습니다.");
        }
        return $next($request);
    }
}
