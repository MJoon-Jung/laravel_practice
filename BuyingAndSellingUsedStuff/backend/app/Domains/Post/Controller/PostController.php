<?php

namespace App\Domains\Post\Controllers;

use App\Domains\Post\Interfaces\PostRepositoryInterface;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $posts = $this->repository->getAll();

        return response()->json([
            'status' => 200,
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {
        $post = $this->repository->getPost($id);

        return response()->json([
            'status' => 200,
            'posts' => $post,
        ]);
    }
}
