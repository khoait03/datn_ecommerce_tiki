<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'posts';
    use HasFactory;

    protected $fillable = [
        'category_post_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'meta_title',
        'meta_keyword',
        'user_id',
        'tags',
        'meta_description',
        'shop_id'
    ];
    protected $casts = [
        'tags' => 'array',
        'meta_keyword' => 'array',
    ];

    public static function boot()
    {
        parent::boot(); // Call parent's boot method first

        static::creating(function ($shop) {

            $shop->user_id = Auth::id();
        });
    }

    public function categoryPost(): BelongsTo
    {
        return $this->BelongsTo(CategoryPost::class);
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($post) {
            $user = Auth::user();
            if ($user) {
                $post->shop_id = $user->shop_id;
                $post->save();
            }
        });
    }
}
