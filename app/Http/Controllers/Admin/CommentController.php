<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('article')->orderBy('is_approved')->orderByDesc('created_at')->paginate(15);

        return view('admin.comments', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);

        return back()->with('status', 'Đã duyệt bình luận.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('status', 'Đã xóa bình luận.');
    }
}
