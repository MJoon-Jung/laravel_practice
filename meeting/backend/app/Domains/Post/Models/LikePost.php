<?php

namespace App\Domains\Post\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LikePost extends Pivot
{
    public $incrementing = true;
    
    protected $fillable = [
        'user_id',
        'post_id',
    ];
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
