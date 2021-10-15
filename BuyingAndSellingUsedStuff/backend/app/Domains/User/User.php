<?php

namespace App\Domains\User;

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
        return $this->hasMany("App\Models\Friend", 'user_id');
    }
    public function receiveFriend()
    {
        return $this->hasMany("App\Models\Friend", 'friend_id');
    }
    public function groups()
    {
        return $this->hasMany('App\Models\GroupUser');
    }
    public function likePosts()
    {
        return $this->hasMany('App\Models\LikePost');
    }
    public function posts()
    {
        return $this->hasMany('App\Domains\Post\Post');
    }
    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room')->using('App\Models\RoomUser');
    }
    public function roomchats()
    {
        return $this->hasMany('App\Models\Roomchat');
    }
}
