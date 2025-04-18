# Tạo cache cấu hình để tăng hiệu suất
php artisan migrate

composer dump-autoload -o
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan queue:work


php artisan key:generate


php artisan route:cache
php artisan view:cache
composer dump-autoload -o


# DANH SÁCH TRANG NGƯỜI DÙNG CẦN CÓ
1. Trang chủ (Home)
Giới thiệu hệ thống đánh giá thương hiệu.

Các thương hiệu nổi bật.

CTA: “Tìm thương hiệu để đánh giá”.

2. Trang tìm kiếm & đánh giá thương hiệu
Thanh tìm kiếm thương hiệu (autocomplete).
Khi tìm thấy:

Tổng quan đánh giá (cảm xúc, từ khóa, phân tích AI).
Biểu đồ cảm xúc (Pie/Bar).
Từ khóa nổi bật (word cloud hoặc tag list).

Phân tích từ GPT / PhoBERT.

3. Trang so sánh thương hiệu
Giao diện chọn 2–3 thương hiệu.

So sánh:
Tỉ lệ cảm xúc.
Từ khóa.
GPT đánh giá thương hiệu nào tốt hơn.

Biểu đồ đối chiếu.

6. Trang liên hệ / góp ý
Form liên hệ hoặc gửi góp ý với hệ thống.

Email, thông tin dự án (nếu mã nguồn mở hoặc học thuật).

7. Trang giới thiệu hệ thống (About)
Mô tả mục tiêu hệ thống.

Công nghệ sử dụng (Facebook, GPT, LangChain…).

Đảm bảo minh bạch nguồn dữ liệu.

8. Trang đăng nhập / đăng ký (nếu cần đăng nhập người dùng)

php artisan serve --host=ttt_219911.com --port=80






