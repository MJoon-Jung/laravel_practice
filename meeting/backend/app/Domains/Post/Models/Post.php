<?php

namespace App\Domains\Post\Models;

use App\Domains\Image\Models\ImagePost;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likePosts()
    {
        return $this->hasMany(LikePost::class);
    }
    public function images()
    {
        return $this->hasMany(ImagePost::class);
    }
}
