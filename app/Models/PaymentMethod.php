<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    use HasFactory;

    protected $fillable = [
        'method_name',
        'shop_id'
    ];

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
