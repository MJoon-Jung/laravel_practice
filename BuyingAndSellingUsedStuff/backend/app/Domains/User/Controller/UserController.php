<?php

namespace App\Domains\User\Controller;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Repository\User\UserRepositoryInterface;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json([$this->userService->all()], 200);
    }
    public function show(int $id)
    {
        return response()->json([$this->userService->findById($id)], 200);
    }
}
