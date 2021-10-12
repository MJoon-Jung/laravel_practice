<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // public function users()
    // {
    //     return $this->hasMany('App\Domains\User\User')->using('App\Models\GroupUser');
    // }
    public function users()
    {
        return $this->hasMany('App\Models\GroupUser');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\GroupUser');
    }
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
