<?php

namespace App\Domains\Post;

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
        return $this->belongsTo('App\Domains\User\User');
    }
    public function likePosts()
    {
        return $this->hasMany('App\Models\LikePost');
    }
    public function images()
    {
        return $this->hasMany('App\Models\ImagePost');
    }
}
