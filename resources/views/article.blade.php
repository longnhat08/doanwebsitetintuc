@extends('layouts.app')
@section('title', $article->title)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <article class="bg-white p-4 shadow-sm rounded">
            <a href="{{ route('category', $article->category->slug) }}" class="badge bg-danger text-decoration-none">{{ $article->category->name }}</a>
            <h1 class="h2 mt-2">{{ $article->title }}</h1>
            <p class="text-muted small">
                {{ $article->user->name }} &middot; {{ optional($article->published_at)->format('d/m/Y H:i') }} &middot; {{ $article->views }} lượt xem
            </p>
            <p class="fw-semibold">{{ $article->summary }}</p>
            <img src="{{ $article->image_url }}" class="img-fluid rounded mb-3" alt="">
            <div class="article-body">{!! nl2br(e($article->content)) !!}</div>
        </article>

        <section class="bg-white p-4 shadow-sm rounded mt-4">
            <h5>Bình luận ({{ $comments->count() }})</h5>
            @forelse($comments as $c)
                <div class="border-bottom py-2">
                    <strong>{{ $c->author_name }}</strong>
                    <small class="text-muted">{{ $c->created_at->format('d/m/Y H:i') }}</small>
                    <div>{{ $c->content }}</div>
                </div>
            @empty
                <p class="text-muted">Chưa có bình luận nào.</p>
            @endforelse

            <form action="{{ route('comment.store', $article->id) }}" method="post" class="mt-3">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger py-2">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
                @endif
                <div class="mb-2"><input name="author_name" class="form-control" placeholder="Tên của bạn" value="{{ old('author_name') }}"></div>
                <div class="mb-2"><textarea name="content" rows="3" class="form-control" placeholder="Nội dung bình luận">{{ old('content') }}</textarea></div>
                <button class="btn btn-danger">Gửi bình luận</button>
            </form>
        </section>
    </div>
    <div class="col-lg-4">
        <h5 class="border-start border-danger border-4 ps-2">Tin liên quan</h5>
        @foreach($related as $r)
            <div class="mb-3">@include('partials.card', ['article' => $r->setRelation('category', $article->category)])</div>
        @endforeach
    </div>
</div>
@endsection
