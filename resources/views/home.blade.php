@extends('layouts.app')

@section('content')
@if($featured)
    <div class="card mb-4 shadow-sm">
        <img src="{{ $featured->image_url }}" class="hero-img card-img-top" alt="">
        <div class="card-body">
            <span class="badge bg-danger">{{ $featured->category->name }}</span>
            <h2 class="mt-2"><a class="text-dark text-decoration-none" href="{{ route('article.show', $featured->slug) }}">{{ $featured->title }}</a></h2>
            <p class="text-muted mb-0">{{ $featured->summary }}</p>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-lg-9">
        <h4 class="border-start border-danger border-4 ps-2 mb-3">Tin mới nhất</h4>
        <div class="row g-3">
            @forelse($latest as $article)
                <div class="col-md-6 col-xl-4">@include('partials.card', ['article' => $article])</div>
            @empty
                <p class="text-muted">Chưa có bài viết.</p>
            @endforelse
        </div>
        <div class="mt-4">{{ $latest->links() }}</div>
    </div>
    <div class="col-lg-3">
        <h5 class="border-start border-danger border-4 ps-2 mb-3">Xem nhiều</h5>
        <ol class="list-group list-group-numbered">
            @foreach($popular as $p)
                <li class="list-group-item"><a href="{{ route('article.show', $p->slug) }}" class="text-decoration-none text-dark">{{ $p->title }}</a></li>
            @endforeach
        </ol>
    </div>
</div>
@endsection
