<?php

namespace App\Domains\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'friend_id'
    ];

    public function requestFriend()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function receiveFriend()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
