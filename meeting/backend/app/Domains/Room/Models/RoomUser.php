<?php

namespace App\Domains\Room\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomUser extends Pivot
{
    public $incrementing = true;
    
    protected $fillable = [
        'user_id',
        'room_id',
        'room_admin'
    ];
}
