<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ShopInfo extends Model
{
    protected $table = 'shop_infos';
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'banking_id',
        'user_name_bank',
        'number_bank',
        'profile_number',
        'front_side',
        'back_side',
        'portrait_photo',
        'national_id'
    ];

    public function Shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function Banking(): BelongsTo
    {
        return $this->belongsTo(Banking::class);
    }
    protected static function booted()
    {
        static::created(function ($shopinfo) {
            $user = Auth::user();
            if ($user) {
                $shopinfo->shop_id = $user->shop_id;
                $shopinfo->save();
                Notification::make()
                    ->title('Bạn đã cập nhật thông tin Thành Công')
                    ->body('Bây giờ bạn đã có thể vào đăng sản phẩm để bắt bắt đầu bán hàng')
                    ->sendToDatabase($user);
            }
        });
    }
}
