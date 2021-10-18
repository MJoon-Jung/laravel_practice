<?php

namespace App\Domains\Post\Middleware;

use App\Domains\Post\Models\LikePost;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckPostLike
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
            $exLike = LikePost::where('post_id', $id)->where('user_id', Auth::user()->id)->get();
        } catch (ModelNotFoundException $exception) {
            throw new HttpException(403, "좋아요를 누른 상태가 아닙니다.");
        }
        $request->$exLike = $exLike;
        return $next($request);
    }
}
