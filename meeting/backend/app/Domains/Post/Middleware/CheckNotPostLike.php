<?php

namespace App\Domains\Post\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckNotPostLike
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
        try {
            $exLike = DB::table('like_post')->where('post_id', $id)->where('user_id', Auth::user()->id)->get();
        } catch (ModelNotFoundException $exception) {
            return $next($request);
        }
        throw new HttpException('403', '이미 좋아요를 누른 상태입니다.');
    }
}
