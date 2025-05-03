# Hệ Thống Đánh Giá Thương Hiệu Dựa Trên Dữ Liệu Mạng Xã Hội Facebook

## Mô Tả Dự Án
Dự án này giúp người dùng trực quan hóa và tổng hợp dữ liệu thu thập từ các nhóm và fanpage trên Facebook, bao gồm các bình luận và bài viết. Các tính năng chính của hệ thống bao gồm thu thập dữ liệu từ các bình luận và bài viết, sau đó đánh giá và trực quan hóa kết quả.

## Công Cụ và Framework
- **Framework**: Laravel 12
- **Cơ sở dữ liệu**: MySQL
- **Giao diện**: Bootstrap
- **Trực quan dữ liệu**: Chart.js

## Cài Đặt
1. Tải dự án về và chạy trên VSCode hoặc IDE hỗ trợ Laravel.
2. Cài đặt các thư viện phụ thuộc với lệnh:
   ```bash
   composer install
    ```

3. Chạy dự án với lệnh:
    ```bash
    composer run dev
    ```
4. Cấu hình cơ sở dữ liệu:

- Sử dụng XAMPP để chạy MySQL.

- Tạo cơ sở dữ liệu trong phpMyAdmin và nhập file dữ liệu từ public/db/danh_gia_thuong_hieu.sql.

- Cấu hình kết nối cơ sở dữ liệu trong tệp .env:

- DB_HOST=localhost

- DB_DATABASE=[Tên cơ sở dữ liệu]

- DB_USERNAME=root

- DB_PASSWORD=[Mật khẩu của bạn]

## Cấu Hình Dự Án
- Cấu hình kết nối cơ sở dữ liệu trong tệp .env như đã mô tả ở trên.

- Cấu hình các yếu tố khác như SEO, metadata có thể được thực hiện qua trang quản trị.

## Hướng Dẫn Sử Dụng

- Trang chủ: Hiển thị thông tin cơ bản về hệ thống.

- Trang tìm kiếm và đánh giá: Dùng để thu thập dữ liệu từ các bài viết và bình luận.

- Trang đánh giá thương hiệu: Trực quan hóa dữ liệu thương hiệu.

- Trang trực quan dữ liệu: Hiển thị dữ liệu thương hiệu theo từ khóa.

- Trang cá nhân: Xem lịch sử đánh giá và cập nhật thông tin.

## Trang Admin
- Trang admin bao gồm các tính năng:

- Cấu hình hệ thống: Kiểm tra và bổ sung cấu hình website.

- Cấu hình metadata và SEO: Thêm thông tin tiêu đề, mô tả, từ khóa, favicon, và các thẻ SEO như meta title, meta description, thẻ Open Graph.

- Quản lý người dùng: Thêm, sửa, xóa người dùng.

- Quản lý thương hiệu: Thêm, chỉnh sửa thông tin về thương hiệu.

- Quản lý yêu cầu đánh giá: Theo dõi và xử lý các yêu cầu đánh giá thương hiệu.