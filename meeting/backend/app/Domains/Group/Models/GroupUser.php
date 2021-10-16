<?php

namespace App\Domains\Group\Models;

use App\Domains\User\Models\User;
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
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsTo(Group::class);
    }
}
