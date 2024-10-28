<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'status',
        'shop_id'
    ];

    public function Product(): HasMany
    {
        return $this->HasMany(Brand::class);
    }
    public function shop(): BelongsTo
    {
        return $this->BelongsTo(Shop::class);
    }
    protected static function booted()
    {
        static::created(function ($brand) {
            $user = Auth::user();
            if ($user) {
                $brand->shop_id = $user->shop_id;
                $brand->save();
            }
        });
    }
}
