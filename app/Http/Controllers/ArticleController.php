<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function show(string $slug)
    {
        $article = Article::published()->with(['category', 'user'])->where('slug', $slug)->firstOrFail();

        $article->increment('views');

        $comments = $article->comments()->where('is_approved', 1)->orderByDesc('created_at')->get();

        $related = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '<>', $article->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('article', compact('article', 'comments', 'related'));
    }
}
