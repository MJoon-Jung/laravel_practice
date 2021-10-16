<?php

namespace App\Domains\Room\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomchat extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $fillable = [
        'content',
        'room_id',
        'user_id'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
