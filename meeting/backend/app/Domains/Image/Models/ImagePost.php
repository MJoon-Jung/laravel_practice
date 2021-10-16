<?php

namespace App\Domains\Image\Models;

use App\Domains\Post\Models\Post;
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
        return $this->belongsTo(Post::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
