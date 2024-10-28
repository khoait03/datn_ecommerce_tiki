# ecommerce-tiki

ecommerce-tiki là dự án website thương mại điện tử đa dạng ngành hàng, đặt hàng, thanh toán, phân quyền...

## Tính năng

- Quản lý sản phẩm, danh mục...
- Phân quyền người dùng với nhiều vai trò
- Đặt hàng, thanh toán...

## Cài đặt

Để cài đặt dự án, bạn cần thực hiện các bước sau:

0. Clone repository:

   ```bash
   git clone https://github.com/khoait03/datn_ecommerce_tiki.git

1. Cài đặt các phụ thuộc:

   ```bash
   cd datn_ecommerce_tiki
   
2. Cài đặt các phụ thuộc:
   ```bash
   composer install

3. Tạo file .env:
   ```bash
   cp .env.example .env

4. Cấu hình file .env:
   Mở file .env và cấu hình các thông số kết nối cơ sở dữ liệu, ứng dụng, và các thông tin khác cần thiết cho dự án.


5. Tạo khóa ứng dụng:
   ```bash
   php artisan key:generate

6. Chạy migration:
   ```bash
   php artisan migrate
   
7. Chạy seeder:
   ```bash
   php artisan db:seed

8. Bây giờ hãy chạy lệnh sau để tạo 1 tài khoản admin:
   ```bash
   php artisan shield:install
   
9. Run project:
   ```bash
   php artisan serve




Truy cập vào địa chỉ: http://127.0.0.1:8000 để xem ứng dụng:
 


Đóng góp
Nếu bạn muốn đóng góp cho dự án, vui lòng tạo pull request và tuân thủ các quy tắc đóng góp.

Giấy phép
Dự án này được cấp phép theo MIT License.
