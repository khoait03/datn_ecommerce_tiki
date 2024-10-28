<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supplier')->insert([
            [
                'name' => 'Fashion Hub',
                'email' => 'contact@fashionhub.com',
                'phone' => '0123456789',
                'address' => '123 Fashion Street, New York, NY',
                'website' => 'http://www.fashionhub.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Style Suppliers',
                'email' => 'info@stylesuppliers.com',
                'phone' => '0987654321',
                'address' => '456 Style Avenue, Los Angeles, CA',
                'website' => 'http://www.stylesuppliers.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trendy Threads',
                'email' => 'sales@trendythreads.com',
                'phone' => '1234567890',
                'address' => '789 Trend Blvd, Chicago, IL',
                'website' => 'http://www.trendythreads.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Modern Apparel',
                'email' => 'contact@modernapparel.com',
                'phone' => '2345678901',
                'address' => '101 Fashion Way, San Francisco, CA',
                'website' => 'http://www.modernapparel.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chic Couture',
                'email' => 'info@chiccouture.com',
                'phone' => '3456789012',
                'address' => '202 Chic Lane, Miami, FL',
                'website' => 'http://www.chiccouture.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Urban Styles',
                'email' => 'sales@urbanstyles.com',
                'phone' => '4567890123',
                'address' => '303 Urban Road, Austin, TX',
                'website' => 'http://www.urbanstyles.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elegance Wear',
                'email' => 'contact@elegancewear.com',
                'phone' => '5678901234',
                'address' => '404 Elegance Avenue, Boston, MA',
                'website' => 'http://www.elegancewear.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classic Clothing',
                'email' => 'info@classicclothing.com',
                'phone' => '6789012345',
                'address' => '505 Classic Street, Seattle, WA',
                'website' => 'http://www.classicclothing.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vogue Vendors',
                'email' => 'sales@voguevendors.com',
                'phone' => '7890123456',
                'address' => '606 Vogue Blvd, Denver, CO',
                'website' => 'http://www.voguevendors.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion Forward',
                'email' => 'contact@fashionforward.com',
                'phone' => '8901234567',
                'address' => '707 Fashion Drive, Houston, TX',
                'website' => 'http://www.fashionforward.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
