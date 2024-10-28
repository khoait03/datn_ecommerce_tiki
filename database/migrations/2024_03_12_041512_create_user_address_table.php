<?php

use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
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
        Schema::create('user_address', function (Blueprint $table) {
            $table->id()->comment('Mã địa chỉ');
            $table->string('name')->nullable(false)->comment('Tên người dùng');
            $table->string('phone')->nullable(false)->comment('Số điện thoại người dùng');
            $table->foreignIdFor(Province::class)->nullable()->comment('Id địa chỉ');
            $table->foreignIdFor(District::class)->nullable()->comment('Id địa chỉ');
            $table->foreignIdFor(Ward::class)->nullable()->comment('Id địa chỉ');
            $table->string('address_specific')->nullable()->comment('Địa chỉ cụ thể');
            $table->tinyInteger('is_default')->default(0)->comment('Địa chỉ mặc định');
            $table->foreignIdFor(User::class)->comment('Mã người dùng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
};
