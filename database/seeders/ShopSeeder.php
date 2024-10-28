<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'name' => 'Thời Trang Hòa Hưng',
                'avatar' => 'https://example.com/images/hoa-hung-avatar.jpg',
                'email' => 'info@hoahung.com',
                'phone' => '0901234567',
                'address' => '123 Đường Hòa Hưng, Quận 10, TP. HCM',
                'description' => 'Thời trang Hòa Hưng là điểm đến lý tưởng cho những bộ trang phục trendy.',
                'rating' => 4.5,
                'status' => 1,
                'follower' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nét Đẹp Việt',
                'avatar' => 'https://example.com/images/net-dep-viet-avatar.jpg',
                'email' => 'contact@netdepviet.com',
                'phone' => '0912345678',
                'address' => '456 Đường Việt, Hà Nội',
                'description' => 'Khám phá những bộ sưu tập thời trang mang đậm bản sắc văn hóa Việt.',
                'rating' => 4.2,
                'status' => 1,
                'follower' => 800,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thế Giới Thời Trang',
                'avatar' => 'https://example.com/images/the-gioi-thoi-trang-avatar.jpg',
                'email' => 'sales@thegioithoitrang.com',
                'phone' => '0934567890',
                'address' => '789 Đường Thời Trang, Đà Nẵng',
                'description' => 'Thế giới thời trang, nơi bạn có thể tìm thấy mọi phong cách.',
                'rating' => 4.7,
                'status' => 1,
                'follower' => 1200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phong Cách Hiện Đại',
                'avatar' => 'https://example.com/images/phong-cach-hien-dai-avatar.jpg',
                'email' => 'info@phongcachhiendai.com',
                'phone' => '0945678901',
                'address' => '101 Đường Hiện Đại, Hải Phòng',
                'description' => 'Cập nhật xu hướng thời trang hiện đại mỗi ngày.',
                'rating' => 4.0,
                'status' => 1,
                'follower' => 950,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cửa Hàng Vintage',
                'avatar' => 'https://example.com/images/cua-hang-vintage-avatar.jpg',
                'email' => 'contact@cuahangvintage.com',
                'phone' => '0956789012',
                'address' => '202 Đường Vintage, Nha Trang',
                'description' => 'Khám phá thời trang vintage độc đáo tại cửa hàng chúng tôi.',
                'rating' => 4.3,
                'status' => 1,
                'follower' => 850,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cửa Hàng Cao Cấp',
                'avatar' => 'https://example.com/images/cua-hang-cao-cap-avatar.jpg',
                'email' => 'sales@cuahangcaocap.com',
                'phone' => '0967890123',
                'address' => '303 Đường Cao Cấp, Bình Dương',
                'description' => 'Trải nghiệm thời trang cao cấp với chất lượng tuyệt vời.',
                'rating' => 4.8,
                'status' => 1,
                'follower' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thời Trang Thanh Lịch',
                'avatar' => 'https://example.com/images/thoi-trang-thanh-lich-avatar.jpg',
                'email' => 'info@thoitrangthanhlch.com',
                'phone' => '0978901234',
                'address' => '404 Đường Thanh Lịch, Đà Lạt',
                'description' => 'Mua sắm các bộ trang phục thanh lịch và tinh tế.',
                'rating' => 4.6,
                'status' => 1,
                'follower' => 1100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thời Trang Mới',
                'avatar' => 'https://example.com/images/thoi-trang-moi-avatar.jpg',
                'email' => 'contact@thoitrangmoi.com',
                'phone' => '0989012345',
                'address' => '505 Đường Mới, Cần Thơ',
                'description' => 'Giữ phong cách hiện đại với bộ sưu tập thời trang mới nhất.',
                'rating' => 4.4,
                'status' => 1,
                'follower' => 950,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phong Cách Năng Động',
                'avatar' => 'https://example.com/images/phong-cach-nang-dong-avatar.jpg',
                'email' => 'sales@phongcachnangdong.com',
                'phone' => '0912345678',
                'address' => '606 Đường Năng Động, Vũng Tàu',
                'description' => 'Mua sắm các bộ trang phục năng động và thời thượng.',
                'rating' => 4.1,
                'status' => 1,
                'follower' => 700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
