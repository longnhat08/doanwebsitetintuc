<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'Bài viết'          => $user->isAdmin() ? Article::count() : Article::where('user_id', $user->id)->count(),
            'Chuyên mục'        => Category::count(),
            'Bình luận chờ duyệt' => Comment::where('is_approved', 0)->count(),
            'Liên hệ'           => Contact::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
