<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testDatabase()
    {
        $comment = Comment::factory()->count(10)->create();
    }
}
