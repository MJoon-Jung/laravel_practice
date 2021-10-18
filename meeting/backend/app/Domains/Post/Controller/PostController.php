<?php

namespace App\Domains\Post\Controller;

use App\Domains\Image\Models\Image;
use App\Domains\Image\Models\ImagePost;
use App\Domains\Post\Models\LikePost;
use App\Domains\Post\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PostController extends Controller
{
    
    /**
     *
     * @OA\Get(
     *     path="/api/posts",
     *     summary="전체 게시물 조회",
     *     @OA\Response(
     *         response=200,
     *         description="전체 게시물 조회 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function index(): ?Collection
    {
        $posts = Post::with(['user', 'images', 'likePosts'])->get();
        
        return $posts;
    }
    /**
     *
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="특정 게시물 조회",
     *     @OA\Response(
     *         response=200,
     *         description="특정 게시물 조회 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function show(int $postId): ?Collection
    {
        return Post::where('id', $postId)->with(['users', 'likePost', 'images'])->get();
    }
    /**
     *
     * @OA\Post(
     *     path="/api/posts",
     *     summary="게시물 등록",
     *     @OA\Response(
     *         response=201,
     *         description="게시물 등록 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function store(Request $request): ?JsonResponse
    {
        $request->validate([
            'title' => 'required|max:100|min:1',
            'content' => 'required|min:1',
        ]);
        
        DB::transaction(function () use ($request) {
            $post = new Post([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);
            $post->save();

            if ($request?->image) {
                $image = new Image([
                    'image' => $request->image,
                ]);
                $image->save();
    
                $imagePost = new ImagePost([
                    'user_id' => Auth::user()->id,
                    'post_id' => $post->id,
                ]);
                $imagePost->save();
            }
        });

        return response()->json(["message" => "create success"], 201);
    }
    /**
     *
     * @OA\Post(
     *     path="/api/posts/image",
     *     summary="게시물 이미지 저장",
     *     @OA\Response(
     *         response=201,
     *         description="게시물 이미지 저장 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function image(Request $request): ?JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        $image = $request->file('image')->store('public');
        return response()->json($image, 201);
    }
    /**
     *
     * @OA\Patch(
     *     path="/api/posts/{id}",
     *     summary="게시물 수정",
     *     @OA\Response(
     *         response=200,
     *         description="게시물 수정 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function update(Request $request): ?JsonResponse
    {
        $request->validate([
            'title' => 'required|max:100|min:1',
            'content' => 'required|min:1',
        ]);

        $post = $request->expost;

        DB::transaction(function () use ($request, $post) {
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = Auth::user()->id;
            $post->save();
            
            if ($request?->image) {
                //request에 이미지가 있다면 이미지를 바꾼 것이므로 다 삭제하고 새로 넣음
                $exImagePost = ImagePost::where('post_id', $post->id)->get();
                Image::where('id', $exImagePost[0]->id)->delete();

                $image = new Image([
                    'image' => $request->image,
                ]);
                $image->save();
    
                $imagePost = new ImagePost([
                    'user_id' => Auth::user()->id,
                    'post_id' => $post->id,
                ]);
                $imagePost->save();
            }
        });

        return response()->json(["message" => "update success"], 200);
    }
    /**
     *
     * @OA\Patch(
     *     path="/api/posts/{id}/like",
     *     summary="게시물 좋아요",
     *     @OA\Response(
     *         response=200,
     *         description="게시물 좋아요 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function like(int $postId): ?JsonResponse
    {
        $like = new LikePost([
            'user_id'=> Auth::user()->id,
            'post_id'=> $postId,
        ]);
        $like->save();
        return response()->json(["message"=> "like success"]);
    }
    /**
     *
     * @OA\Delete(
     *     path="/api/posts/{id}/like",
     *     summary="게시물 좋아요 취소",
     *     @OA\Response(
     *         response=200,
     *         description="게시물 좋아요 취소 성공"
     *     ),
     *     tags={"Post"},
     * )
     */
    public function unLike(Request $request): ?JsonResponse
    {
        $like = $request->exLike;
        $like->delete();
        return response()->json(["message"=> "unlike success"]);
    }
}
