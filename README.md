# Tạo cache cấu hình để tăng hiệu suất
php artisan migrate

composer dump-autoload -o
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan key:generate


php artisan route:cache
php artisan view:cache
composer dump-autoload -o

# Chạy dự án
php artisan serve --host=ttt_219911.com --port=80




