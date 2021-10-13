<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'string',
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\ImagePost');
    }
}
