<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    public $incrementing = true;
    
    protected $fillable = [
        'user_id',
        'group_id',
        'group_admin'
    ];
}
