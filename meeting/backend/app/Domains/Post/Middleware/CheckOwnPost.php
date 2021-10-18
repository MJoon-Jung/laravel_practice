<?php

namespace App\Domains\Post\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckOwnPost
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
        $post = $request->exPost;
        if ($post->user_id !== Auth::user()->id) {
            throw new HttpException(403, '게시물을 작성한 유저가 아닙니다.');
        }
        return $next($request);
    }
}
