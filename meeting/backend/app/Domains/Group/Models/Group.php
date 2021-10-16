<?php

namespace App\Domains\Group\Models;

use App\Domains\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // public function users()
    // {
    //     return $this->hasMany('App\Domains\User\Models\User')->using('App\Domains\Group\Models\GroupUser');
    // }
    public function users()
    {
        return $this->hasMany(GroupUser::class);
    }
    public function user()
    {
        return $this->belongsTo(GroupUser::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
