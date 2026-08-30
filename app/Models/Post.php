<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'category_id', 'body', 'is_featured', 'thumbnail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
