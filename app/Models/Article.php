<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'author',
        'uploader',
        'tags',
        'published_at',
        'views'
    ];
}
