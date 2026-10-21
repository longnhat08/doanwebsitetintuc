<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

// ===== Trang công khai =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/chuyen-muc/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('/bai-viet/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::post('/bai-viet/{article}/binh-luan', [CommentController::class, 'store'])->name('comment.store');
Route::get('/lien-he', [ContactController::class, 'create'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');

// ===== Đăng nhập =====
Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.submit');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');

// ===== Khu quản trị =====
Route::prefix('quan-tri')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Biên tập viên + Quản trị viên
    Route::resource('articles', Admin\ArticleController::class)->except('show');

    // Chỉ quản trị viên
    Route::middleware(AdminOnly::class)->group(function () {
        Route::resource('categories', Admin\CategoryController::class)->except('show');
        Route::resource('users', Admin\UserController::class)->only(['index', 'create', 'store', 'destroy']);

        Route::get('comments', [Admin\CommentController::class, 'index'])->name('comments.index');
        Route::patch('comments/{comment}/approve', [Admin\CommentController::class, 'approve'])->name('comments.approve');
        Route::delete('comments/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');

        Route::get('contacts', [Admin\ContactController::class, 'index'])->name('contacts.index');
        Route::delete('contacts/{contact}', [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
    });
});
