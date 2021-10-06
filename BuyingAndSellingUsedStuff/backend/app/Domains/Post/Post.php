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
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
    public function likePost()
    {
        return $this->hasMany('App\Models\LikePost');
    }
}
