<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'users' => User::all(),
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'user' => $user,
        ], status: 200);
    }
}
