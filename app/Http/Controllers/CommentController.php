<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        abort_unless($article->status === 'published', 404);

        $data = $request->validate([
            'author_name' => 'required|string|max:100',
            'content'     => 'required|string|max:1000',
        ]);

        Comment::create($data + ['article_id' => $article->id, 'is_approved' => false]);

        return redirect()->route('article.show', $article->slug)
            ->with('status', 'Bình luận đã được gửi và đang chờ duyệt.');
    }
}
