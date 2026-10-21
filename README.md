# Website tin tức (Laravel 11/12 + MySQL)

Bài tập: Phân tích thiết kế và lập trình website tin tức.

## Chức năng
- Độc giả: trang chủ, xem theo chuyên mục, chi tiết bài viết (tăng lượt xem), tìm kiếm, bình luận (chờ duyệt), liên hệ.
- Biên tập viên: đăng nhập, thêm/sửa/xóa **bài viết của mình** (có upload ảnh).
- Quản trị viên: toàn quyền bài viết; CRUD chuyên mục; thêm/xóa người dùng; duyệt/xóa bình luận; xem/xóa liên hệ.

## Công nghệ
Laravel 11/12, PHP 8.2+, MySQL (Laragon), Bootstrap 5, Eloquent ORM, Blade.

## Cài đặt (Windows)
Yêu cầu: cài **Laragon Full** (https://laragon.org/download) - đã gồm PHP, MySQL, Composer, Git.

1. Mở Laragon → **Start All**.
2. Tạo CSDL: Laragon → Database (HeidiSQL) → mở `database/newsdb.sql` → chạy (F9). Mật khẩu root mặc định để trống.
3. Mở Laragon → **Terminal**, vào thư mục chứa `setup.bat` và chạy `setup.bat` (hoặc làm tay: `composer create-project laravel/laravel tintuc`, chép thư mục `overlay` đè lên).
4. Kiểm tra `.env` (DB_USERNAME=root, DB_PASSWORD để trống), rồi trong thư mục `tintuc`:
```
php artisan key:generate
php artisan storage:link
php artisan serve
```
Mở http://localhost:8000

## Tài khoản mẫu
| Vai trò | Email | Mật khẩu |
|---|---|---|
| Quản trị viên | admin@news.test | Admin@123 |
| Biên tập viên | editor@news.test | Editor@123 |

Đăng nhập tại `/dang-nhap`, khu quản trị tại `/quan-tri`.

## Cấu trúc CSDL
users, categories, articles, comments, contacts (xem `database/newsdb.sql`).


