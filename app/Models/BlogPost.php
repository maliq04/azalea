<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'cover_image',
        'author',
        'category',
        'read_time',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Use the slug column for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function likes(): HasMany
    {
        return $this->hasMany(BlogLike::class, 'post_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'post_id');
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likeCount(): int
    {
        return $this->likes()->count();
    }
}
