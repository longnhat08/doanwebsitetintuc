<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Article::published()->with('category')->orderByDesc('published_at')->first();

        $latest = Article::published()->with('category')
            ->when($featured, fn ($q) => $q->where('id', '<>', $featured->id))
            ->orderByDesc('published_at')
            ->paginate(6);

        $popular = Article::published()->orderByDesc('views')->limit(5)->get();

        return view('home', compact('featured', 'latest', 'popular'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::published()->with('category')
            ->where('category_id', $category->id)
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('category', compact('category', 'articles'));
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $articles = Article::published()->with('category')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                      ->orWhere('summary', 'like', "%{$q}%");
                });
            }, fn ($query) => $query->whereRaw('1 = 0'))
            ->orderByDesc('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('search', compact('articles', 'q'));
    }
}
