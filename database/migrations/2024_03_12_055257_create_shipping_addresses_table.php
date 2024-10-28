<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Order;
use App\Models\Province;
Use App\Models\District;
use App\Models\Ward;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id()->comment('Mã địa chỉ');
            $table->string('name')->nullable(false)->comment('Tên người dùng');
            $table->string('phone')->nullable(false)->comment('Số điện thoại người dùng');
            $table->string('street')->comment('Địa chỉ cụ thể');
            $table->foreignIdFor(Province::class)->nullable()->comment('Id địa chỉ Tỉnh');
            $table->foreignIdFor(District::class)->nullable()->comment('Id địa chỉ Quận');
            $table->foreignIdFor(Ward::class)->nullable()->comment('Id địa chỉ Phường');
            $table->tinyInteger('status')->default(1)->comment('Trang thai');
            $table->foreignIdFor(Order::class)->nullable()->comment('Mã đơn hàng');
            $table->foreignIdFor(User::class)->comment('Mã người dùng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
