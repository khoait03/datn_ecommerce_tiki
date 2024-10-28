<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


       DB::table('shipping_addresses')->insert([
            'name' => 'Nguyễn Văn A',
            'phone' => '0123456',
            'street' => 'Số 1 Đường Nguyễn Văn Trỗi',
            'province_id' => '1',
            'district_id' => '1',
            'ward_id' => '1',
            'status' => '1',
            'user_id' => '1',
        ]);
    }
}
