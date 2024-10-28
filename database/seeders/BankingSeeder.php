<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $banks = [
            ['name' => 'VPBank'],
            ['name' => 'BIDV'],
            ['name' => 'Vietcombank'],
            ['name' => 'VietinBank'],
            ['name' => 'MBBANK'],
            ['name' => 'ACB'],
            ['name' => 'SHB'],
            ['name' => 'Techcombank'],
            ['name' => 'Agribank'],
            ['name' => 'HDBank'],
            ['name' => 'LienVietPostBank'],
            ['name' => 'VIB'],
            ['name' => 'SeABank'],
            ['name' => 'VBSP'],
            ['name' => 'TPBank'],
            ['name' => 'OCB'],
            ['name' => 'MSB'],
            ['name' => 'Sacombank'],
            ['name' => 'Eximbank'],
            ['name' => 'SCB'],
            ['name' => 'VDB'],
            ['name' => 'Nam A Bank'],
            ['name' => 'ABBANK'],
            ['name' => 'PVcomBank'],
            ['name' => 'Bac A Bank'],
            ['name' => 'UOB'],
            ['name' => 'Woori'],
            ['name' => 'HSBC'],
            ['name' => 'SCBVL'],
            ['name' => 'PBVN'],
            ['name' => 'SHBVN'],
            ['name' => 'NCB'],
            ['name' => 'VietABank'],
            ['name' => 'Viet Capital Bank'],
            ['name' => 'DongA Bank'],
            ['name' => 'Vietbank'],
            ['name' => 'ANZVL'],
            ['name' => 'OceanBank'],
            ['name' => 'CIMB'],
            ['name' => 'Kienlongbank'],
            ['name' => 'IVB'],
            ['name' => 'BAOVIET Bank'],
            ['name' => 'SAIGONBANK'],
            ['name' => 'Co-opBank'],
            ['name' => 'GPBank'],
            ['name' => 'VRB'],
            ['name' => 'CB'],
            ['name' => 'HLBVN'],
            ['name' => 'PG Bank']
        ];

        DB::table('banking')->insert($banks);
    }

}
