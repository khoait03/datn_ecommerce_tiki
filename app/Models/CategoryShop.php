<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryShop extends Model
{
    use HasFactory;

    protected $table = 'category_shops';

    protected $fillable = [
        'category_id',
        'shop_id'
    ];
    public function Category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }
    public function shop(): BelongsTo
    {
        return $this->BelongsTo(Shop::class);
    }
    // Accessor để lấy tên đầy đủ của danh mục
    public function getCategoryFullNameAttribute()
    {
        return $this->category ? $this->category->full_name : null;
    }
}
