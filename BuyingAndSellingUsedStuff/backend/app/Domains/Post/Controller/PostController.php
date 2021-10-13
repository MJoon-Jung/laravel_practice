<?php

namespace App\Domains\Post\Controller;

use App\Domains\Post\Post;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ImagePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'images', 'likePosts'])->get();
        return $posts;
    }
    public function show(int $postId)
    {
        Post::where('id', $postId)->with(['users', 'likePost', 'images'])->get();
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100|min:1',
            'content' => 'required|min:1'
        ]);
        
        DB::transaction(function () use ($request) {
            $post = new Post([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);
            $post->save();

            if (!empty($request->image)) {
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

        return response()->json(["message" => "success"], 201);
    }
    public function image(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        return $request->file('image')->store('public');
    }
}
