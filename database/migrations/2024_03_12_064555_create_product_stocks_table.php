<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id()->comment('Mã kho sản phẩm');
            $table->bigInteger('sku')->nullable()->comment('Mã SKU');
            $table->integer('import_price')->nullable()->comment('Giá nhập vào');
            $table->integer('retail_price')->nullable()->comment('Giá bán lẻ');
            $table->integer('wholesale_price')->nullable()->comment('Giá bán sỉ');
            $table->integer('qty_inventory')->nullable(false)->comment('Số lượng tồn');
            $table->foreignIdFor(\App\Models\Product::class)->nullable(false)->comment('sku');
            $table->string('media')->nullable()->comment('Ảnh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
    }
};
