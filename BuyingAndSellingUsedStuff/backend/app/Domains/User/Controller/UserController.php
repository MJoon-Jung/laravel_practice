<?php

namespace App\Domains\User\Controller;

use App\Domains\User\Dto\CreateUserProfileDto;
use App\Domains\User\Services\UserService;
use App\Domains\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show(User $user)
    {
        // return response()->json([$this->userService->findById($id)], 200);
        return response()->json(['user' => $user]);
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|min:1',
            'gender' => 'required',
        ]);

        $profile = new CreateUserProfileDto();
        $profile = $profile->fromRequest($request);
        
        return response()->json([$this->userService->updateProfile(auth()->user()->id, $profile)], 200);
    }
    public function image(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        return $request->file('image')->store('public');
    }
    public function destroy()
    {
        return response()->json([$this->userService->destroy(auth()->user()->id)], 200);
    }
}
