<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class CategoryPost extends Model
{
    protected $table = 'category_posts';
    use HasFactory;

    protected $fillable = [
        'name',
        'shop_id'
    ];

    public function post(): HasMany
    {
        return $this->HasMany(Post::class);
    }
    protected static function booted()
    {
        static::created(function ($categoryPost) {
            $user = Auth::user();
            if ($user) {
                $categoryPost->shop_id = $user->shop_id;
                $categoryPost->save();
            }
        });
    }
}
