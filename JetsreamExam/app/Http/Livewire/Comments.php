<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Comments extends Component
{
    public function render()
    {
        $comments = DB::table('comments')->get();
        return view('livewire.comments', compact('comments'));
    }
}