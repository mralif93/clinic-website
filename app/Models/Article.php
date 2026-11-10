<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'content',
        'author_name',
        'image_path',
        'read_time_minutes',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'read_time_minutes' => 'integer',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }
}
