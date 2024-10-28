<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'shop_id',
        'product_image',
        'product_price',
        'product_id',
        'product_quantity'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function Shop(): BelongsTo
    {
        return $this->BelongsTo(Shop::class);
    }

    public function Product(): BelongsTo
    {
        return $this->BelongsTo(Product::class);
    }
}
