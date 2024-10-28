<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class VoucherType extends Model
{
    use HasFactory;

    protected $table = 'voucher_types';

    protected $fillable = [
        'name',
        'status',
        'shop_id'
    ];

    protected static function booted()
    {
        static::created(function ($voucher_types) {
            $user = Auth::user();
            if ($user) {
                $voucher_types->shop_id = $user->shop_id;
                $voucher_types->save();
            }
        });
    }
}
