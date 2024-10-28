<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Shop;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_shops', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->nullable()->comment('Danh mục mà shop sở hữu');
            $table->foreignIdFor(Shop::class)->nullable()->comment('shop sở hữu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_shop');
    }
};
