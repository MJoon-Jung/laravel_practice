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
    public $incrementing = false;
    
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
        return $this->hasMany($this, 'user_id');
    }
    public function receiveFriend()
    {
        return $this->hasMany($this, 'friend_id');
    }
    public function groups()
    {
        return $this->belongsToMany('App\Models\Group')->using('App\Models\GroupUser');
    }
    public function likePost()
    {
        return $this->hasMany('App\Models\LikePost');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
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
