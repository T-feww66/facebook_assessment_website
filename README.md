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

- lưu dữ liệu gửi lên vào db user_send_request với status = 0
- có 1 api hoạt động liên tục check xem trong db của bảng user_send_request có cái nào status = 0 không, có -> cào dữ liệu -> đánh giá, không thì không làm gì hết
- làm xong bước trên hiển thị data ra giao diện người dùng

php artisan serve --host=ttt_219911.com --port=80






