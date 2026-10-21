<div class="card h-100 shadow-sm">
    <img src="{{ $article->image_url }}" class="card-img-top" alt="">
    <div class="card-body">
        <a href="{{ route('category', $article->category->slug) }}" class="badge bg-danger text-decoration-none">{{ $article->category->name }}</a>
        <h5 class="card-title mt-2">
            <a href="{{ route('article.show', $article->slug) }}" class="text-dark text-decoration-none">{{ $article->title }}</a>
        </h5>
        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($article->summary, 110) }}</p>
    </div>
    <div class="card-footer bg-white small text-muted">
        {{ optional($article->published_at)->format('d/m/Y H:i') }} &middot; {{ $article->views }} lượt xem
    </div>
</div>
