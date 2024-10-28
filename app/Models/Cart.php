<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'token',
        'user_id',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
