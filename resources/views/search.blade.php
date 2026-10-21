@extends('layouts.app')
@section('title', 'Tìm kiếm')

@section('content')
<h3 class="border-start border-danger border-4 ps-2">Kết quả tìm kiếm: "{{ $q }}"</h3>
<div class="row g-3 mt-1">
    @forelse($articles as $article)
        <div class="col-md-6 col-lg-4">@include('partials.card', ['article' => $article])</div>
    @empty
        <p class="text-muted">Không tìm thấy bài viết phù hợp.</p>
    @endforelse
</div>
<div class="mt-4">{{ $articles->links() }}</div>
@endsection
