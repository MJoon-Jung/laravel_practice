<?php

namespace App\Domains\Post\Middleware;

use App\Domains\Post\Models\Post;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckPostExist
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
            $post = Post::where('id', $id)->get();
        } catch (ModelNotFoundException $exception) {
            throw new HttpException(404, "게시물이 존재하지 않습니다.");
        }
        $request->exPost = $post;
        return $next($request);
    }
}
