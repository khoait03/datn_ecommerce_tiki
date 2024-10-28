<?php

use App\Models\Product;
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
        Schema::create('product_media', function (Blueprint $table) {
            $table->id()->comment('Mã ảnh sản phẩm');
            $table->foreignIdFor(Product::class)->comment('Mã sản phẩm');
            $table->string('media')->nullable()->comment('Ảnh');
            $table->string('name_media')->comment('Tên ảnh');
            $table->tinyInteger('is_main')->nullable(false)->comment('Ảnh chính');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_media');
    }
};
