<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'body', 'is_featured', 'thumbnail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
