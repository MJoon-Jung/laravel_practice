<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testDatabase()
    {
        $comment = Comment::factory()->count(10)->create();
    }
}
