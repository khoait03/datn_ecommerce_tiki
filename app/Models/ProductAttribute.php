<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';
    protected $fillable = [
        'attribute_id',
        'variation_id',
        'product_stock_id',
        'media',
        'product_variation_value_id',
    ];

    public function productStock(): BelongsTo
    {
        return $this->BelongsTo(ProductStock::class);
    }

    public function productVariationValue(): BelongsTo
    {
        return $this->BelongsTo(ProductVariationValue::class);
    }

}
