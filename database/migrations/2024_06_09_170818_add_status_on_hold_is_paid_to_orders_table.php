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
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('on_hold')->default(false)->comment('Trạng thái mặc định là không tạm giữ'); //
            $table->boolean('is_paid')->default(false)->comment(' Trạng thái mặc định là chưa thanh toán');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('on_hold');
            $table->dropColumn('is_paid');
        });
    }
};
