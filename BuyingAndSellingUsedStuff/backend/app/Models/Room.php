<?php

namespace App\Models;

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
        return $this->belongsToMany('App\Models\User')->using('App\Models\RoomUser');
    }
    public function roomchats()
    {
        return $this->hasMany('App\Models\Roomchat');
    }
}
