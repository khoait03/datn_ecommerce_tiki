<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $table = 'shipping_addresses';

    protected $fillable = [
        'name',
        'phone',
        'street',
        'province_id',
        'district_id',
        'ward_id',
        'status',
        'order_id',
        'user_id',
    ];

    public function User(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function Order(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }

    public function Province(): BelongsTo
    {
        return $this->BelongsTo(Province::class);
    }

    public function District(): BelongsTo
    {
        return $this->BelongsTo(District::class);
    }

    public function Ward(): BelongsTo
    {
        return $this->BelongsTo(Ward::class);
    }

}
