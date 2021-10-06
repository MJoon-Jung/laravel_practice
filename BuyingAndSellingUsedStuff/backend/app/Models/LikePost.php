<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LikePost extends Pivot
{
    public $incrementing = true;
    
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
