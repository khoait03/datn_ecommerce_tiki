<?php

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
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
        Schema::create('likes', function (Blueprint $table) {
            $table->id()->comment('Mã danh mục bài viết');
            $table->string('status')->nullable()->comment('Thích hoặc không thích');
            $table->foreignIdFor(User::class)->comment('Mã khách hàng');
            $table->foreignIdFor(Product::class)->comment('Mã sản phẩm');
            $table->foreignIdFor(Review::class)->comment('Mã đánh giá');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
