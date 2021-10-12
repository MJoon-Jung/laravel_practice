<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table='group_user';
    
    protected $fillable = [
        'user_id',
        'group_id',
        'group_admin'
    ];

    public function users()
    {
        return $this->belongsTo('App\Domains\User\User');
    }

    public function groups()
    {
        return $this->belongsTo('App\Models\Group');
    }
}
