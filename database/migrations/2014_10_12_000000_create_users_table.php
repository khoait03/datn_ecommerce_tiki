<?php

use App\Models\District;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\Shop;
use App\Models\UserAddress;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Mã người dùng');
            $table->string('email')->unique();
            $table->string('name')->nullable(false)->comment('Tên người dùng');
            $table->date('birthday')->nullable()->comment('Sinh nhật');
            $table->string('gender')->nullable()->comment('Giới tính');
            $table->string('phone')->unique()->nullable()->comment('Số điện thoại người dùng');
            $table->string('password')->nullable(false)->comment('Mật khẩu');
            $table->foreignIdFor(UserAddress::class)->nullable()->comment('Id địa chỉ');
            $table->foreignIdFor(Province::class)->nullable()->comment('Id địa chỉ');
            $table->foreignIdFor(District::class)->nullable()->comment('Id địa chỉ');
            $table->foreignIdFor(Ward::class)->nullable()->comment('Id địa chỉ');
            $table->string('avatar')->nullable()->comment('Hình đại diện');
            $table->foreignIdFor(Shop::class)->nullable()->comment('Mã nhà bán');
            $table->string('verification_code')->nullable()->comment('Mã xác thực');
            $table->foreignIdFor(PaymentMethod::class)->nullable()->comment('Phương thức thanh toán');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
