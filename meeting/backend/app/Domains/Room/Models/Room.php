<?php

namespace App\Domains\Room\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function rooms()
    {
        return $this->belongsToMany(User::class)->using(RoomUser::class);
    }
    public function roomchats()
    {
        return $this->hasMany(Roomchat::class);
    }
}
