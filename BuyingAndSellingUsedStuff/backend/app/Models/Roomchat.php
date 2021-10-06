<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Room');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
