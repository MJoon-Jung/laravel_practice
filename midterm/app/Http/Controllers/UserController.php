<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $info = Auth::user()->load('subjects.users');
        return Inertia::render('User/Index', ['info'=>$info]);
    }
    public function show(Subject $subject)
    {
        $subject =  $subject->load('users');
        return Inertia::render('User/Show', ['subject'=>$subject]);
    }
}
