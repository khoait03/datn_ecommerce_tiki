<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\VoucherType;
use App\Models\ShippingAddress;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\Shop;
use App\Models\PaymentMethod;
use App\Models\OrderItem;
use App\Models\OrderDetail;
use App\Models\UserAddress;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->comment('Mã đơn hàng');
            $table->foreignIdFor(Shop::class)->nullable()->comment('Đơn hàng thuộc shop');
            $table->foreignIdFor(ShippingAddress::class)->nullable()->comment('Mã địa chỉ người dùng Mới');
            $table->foreignIdFor(UserAddress::class)->nullable()->comment('Mã địa chỉ người dùng Cũ');
            $table->string('address')->nullable()->nullable(false)->comment('Địa chỉ chính thưc');
            $table->timestamp('delivery_date')->nullable(false)->comment('Ngày vận chuyển');
            $table->integer('total_price')->nullable()->comment('Tổng tiền');
            $table->string('shipping_unit')->nullable(false)->comment('Đơn vị vận chuyển');
            $table->foreignIdFor(User::class)->comment('Mã người dùng');
            $table->foreignIdFor(Voucher::class)->comment('Mã mã giảm giá');
            $table->string('status')->comment('Mã trạng thái đơn hàng');
            $table->foreignIdFor(PaymentMethod::class)->comment('Mã phương thức thanh toán');
            $table->string('cancel_reason')->nullable()->comment('Lý do hủy đơn hàng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
