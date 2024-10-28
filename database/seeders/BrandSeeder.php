<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'Adidas',
                'description' => 'Adidas is a multinational corporation, founded and headquartered in Herzogenaurach, Germany, that designs and manufactures shoes, clothing, and accessories.',
                'image' => 'https://example.com/images/adidas-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike',
                'description' => 'Nike, Inc. is an American multinational corporation that is engaged in the design, development, manufacturing, and worldwide marketing and sales of footwear, apparel, equipment, accessories, and services.',
                'image' => 'https://example.com/images/nike-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zara',
                'description' => 'Zara is a Spanish fast fashion retailer based in Arteixo in Galicia. The company was founded in 1975 by Amancio Ortega and Rosalía Mera.',
                'image' => 'https://example.com/images/zara-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'H&M',
                'description' => 'H&M Hennes & Mauritz AB is a Swedish multinational clothing-retail company known for its fast-fashion clothing for men, women, teenagers, and children.',
                'image' => 'https://example.com/images/hm-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gucci',
                'description' => 'Gucci is an Italian luxury brand of fashion and leather goods. Gucci was founded by Guccio Gucci in Florence, Tuscany, in 1921.',
                'image' => 'https://example.com/images/gucci-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Levi\'s',
                'description' => 'Levi Strauss & Co. is an American clothing company known worldwide for its Levi\'s brand of denim jeans.',
                'image' => 'https://example.com/images/levis-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Calvin Klein',
                'description' => 'Calvin Klein Inc. is an American fashion house established in 1968. It specializes in leather, lifestyle accessories, home furnishings, perfumery, jewellery, watches and ready-to-wear.',
                'image' => 'https://example.com/images/calvin-klein-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ralph Lauren',
                'description' => 'Ralph Lauren Corporation is an American fashion company producing products ranging from the mid-range to the luxury segments. They are known for the clothing, marketing and distribution of products in four categories: apparel, home, accessories, and fragrances.',
                'image' => 'https://example.com/images/ralph-lauren-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tommy Hilfiger',
                'description' => 'Tommy Hilfiger, formerly known as Tommy Hilfiger Corporation and Tommy Hilfiger Inc., is an American premium clothing brand, manufacturing apparel, footwear, accessories, fragrances and home furnishings.',
                'image' => 'https://example.com/images/tommy-hilfiger-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma',
                'description' => 'Puma SE, branded as Puma, is a German multinational corporation that designs and manufactures athletic and casual footwear, apparel and accessories, which is headquartered in Herzogenaurach, Bavaria, Germany.',
                'image' => 'https://example.com/images/puma-logo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
