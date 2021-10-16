<?php

namespace App\Domains\User\Models;

use App\Domains\Group\Models\GroupUser;
use App\Domains\Post\Models\LikePost;
use App\Domains\Post\Models\Post;
use App\Domains\Room\Models\Room;
use App\Domains\Room\Models\Roomchat;
use App\Domains\Room\Models\RoomUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function requestFriend()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }
    public function receiveFriend()
    {
        return $this->hasMany(Friend::class, 'friend_id');
    }
    public function groups()
    {
        return $this->hasMany(GroupUser::class);
    }
    public function likePosts()
    {
        return $this->hasMany(LikePost::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class)->using(RoomUser::class);
    }
    public function roomchats()
    {
        return $this->hasMany(Roomchat::class);
    }
}
