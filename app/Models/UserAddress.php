<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    protected $table = 'user_address';
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address_specific',
        'is_default',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function province(): BelongsTo
    {
        return $this->BelongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->BelongsTo(District::class);
    }

    public function ward(): BelongsTo
    {
        return $this->BelongsTo(Ward::class);
    }
}
