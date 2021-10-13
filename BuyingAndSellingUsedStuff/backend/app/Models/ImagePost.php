<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ImagePost extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $fillable = [
        'post_id',
        'image_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Domains\Post\Post');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }
}
