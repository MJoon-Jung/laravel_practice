<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        if (empty($user->user["hd"])) {
            return redirect()->route('home');
        }
        User::firstOrCreate(
            ['id'=>$user->getId()],
            ['email'=>$user->getEmail()],
        );
        return redirect()->to('/dashboard');
    }
}
