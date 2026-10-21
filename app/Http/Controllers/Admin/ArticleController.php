<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $articles = Article::with(['category', 'user'])
            ->when(! $user->isAdmin(), fn ($q) => $q->where('user_id', $user->id))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.form', [
            'article'    => new Article(['status' => 'published']),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['user_id'] = auth()->id();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('status', 'Đã thêm bài viết.');
    }

    public function edit(Article $article)
    {
        $this->authorizeOwner($article);

        return view('admin.articles.form', [
            'article'    => $article,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeOwner($article);

        $data = $this->validated($request);

        if ($article->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $article->id);
        }

        if ($data['status'] === 'published' && ! $article->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('status', 'Đã cập nhật bài viết.');
    }

    public function destroy(Article $article)
    {
        $this->authorizeOwner($article);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')->with('status', 'Đã xóa bài viết.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'summary'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:published,draft',
            'image'       => 'nullable|image|max:2048',
        ]);
    }

    private function authorizeOwner(Article $article): void
    {
        $user = auth()->user();
        abort_unless($user->isAdmin() || $article->user_id === $user->id, 403, 'Bạn chỉ được sửa/xóa bài viết của mình.');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'bai-viet';
        $slug = $base;
        $i = 2;

        while (Article::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '<>', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
