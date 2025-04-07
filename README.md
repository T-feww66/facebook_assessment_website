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

# DANH SÁCH TRANG ADMIN CẦN CÓ
1. Dashboard (Tổng quan)
Thống kê số lượng thương hiệu, comment, từ khóa.

2. Quản lý Thương hiệu
Danh sách thương hiệu.

Thêm / Sửa / Xoá thương hiệu.

Gán từ khóa cho thương hiệu.

3. Quản lý Comment
Danh sách các comment đã thu thập.

Lọc theo thương hiệu, cảm xúc, thời gian.

Duyệt / xoá / đánh dấu comment.

4. Quản lý Từ khóa
Danh sách từ khóa đang được dùng để thu thập.

Thêm / Sửa / Xoá từ khóa.

Gắn từ khóa với thương hiệu cụ thể.

5. Quản lý Người dùng (nếu có đăng nhập)
Danh sách tài khoản.

Phân quyền (admin, nhân viên...).

Nhật ký hoạt động (logs).

6. Cấu hình hệ thống
Cài đặt API Key (GPT, PhoBERT...).

Lịch trình thu thập dữ liệu.

Cài đặt Facebook crawling (token/cookie...).

7. Theo dõi tiến trình / logs
Log thu thập dữ liệu.

Log phân tích cảm xúc / GPT / lỗi.

Trạng thái hệ thống.

8. So sánh thương hiệu
Chọn 2 hoặc nhiều thương hiệu để so sánh:

Cảm xúc.

Từ khóa nổi bật.

Phân tích GPT.

9. Phân tích chi tiết từng thương hiệu
Trang riêng cho mỗi thương hiệu:

Tỷ lệ cảm xúc.

Từ khóa.

Diễn biến theo thời gian.

Gợi ý cải thiện từ AI.

10. Trang hỗ trợ / tài liệu nội bộ (tuỳ chọn)
Hướng dẫn sử dụng hệ thống.

Thông tin cấu trúc dữ liệu, API nội bộ.


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

Danh sách comment tiêu biểu (ẩn tên người dùng).

3. Trang so sánh thương hiệu
Giao diện chọn 2–3 thương hiệu.

So sánh:

Tỉ lệ cảm xúc.

Từ khóa.

GPT đánh giá thương hiệu nào tốt hơn.

Biểu đồ đối chiếu.

4. Trang danh sách thương hiệu
Lưới thương hiệu (Grid/List).

Bộ lọc: ngành hàng (điện thoại, laptop…), độ nổi tiếng.

Mỗi thương hiệu dẫn đến trang phân tích riêng.

5. Trang phân tích chi tiết thương hiệu
Biểu đồ cảm xúc theo thời gian.

Comment nổi bật gần đây.

GPT/PhoBERT phân tích sâu:

Ưu điểm, nhược điểm thương hiệu.

Gợi ý cải thiện hình ảnh thương hiệu.

6. Trang liên hệ / góp ý
Form liên hệ hoặc gửi góp ý với hệ thống.

Email, thông tin dự án (nếu mã nguồn mở hoặc học thuật).

7. Trang giới thiệu hệ thống (About)
Mô tả mục tiêu hệ thống.

Công nghệ sử dụng (Facebook, GPT, LangChain…).

Đảm bảo minh bạch nguồn dữ liệu.

8. Trang đăng nhập / đăng ký (nếu cần đăng nhập người dùng)
Người dùng có thể lưu lại các so sánh, bình chọn, đánh giá riêng.

(Tùy chọn) có thể cho người dùng gắn cờ comment xấu/spam.