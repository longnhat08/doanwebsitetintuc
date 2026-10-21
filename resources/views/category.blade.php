@extends('layouts.app')
@section('title', $category->name)

@section('content')
<h3 class="border-start border-danger border-4 ps-2">{{ $category->name }}</h3>
<p class="text-muted">{{ $category->description }}</p>
<div class="row g-3">
    @forelse($articles as $article)
        <div class="col-md-6 col-lg-4">@include('partials.card', ['article' => $article])</div>
    @empty
        <p class="text-muted">Chưa có bài viết trong chuyên mục này.</p>
    @endforelse
</div>
<div class="mt-4">{{ $articles->links() }}</div>
@endsection
