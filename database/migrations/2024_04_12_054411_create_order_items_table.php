<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\OrderDetail;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OrderDetail::class)->comment('Mã chi tiết đơn hàng');
            $table->string('product_image')->nullable(false)->comment('Ảnh sản phẩm');
            $table->string('product_price')->nullable(false)->comment('Giá sản phẩm');
            $table->foreignIdFor(Product::class)->comment('Sản phẩm');
            $table->string('product_quantity')->nullable(false)->comment('Số lượng sản phẩm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
