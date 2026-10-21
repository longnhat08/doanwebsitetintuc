@extends('layouts.admin')
@section('title', $article->exists ? 'Sửa bài viết' : 'Thêm bài viết')

@section('content')
<h3>{{ $article->exists ? 'Sửa bài viết' : 'Thêm bài viết' }}</h3>
<form action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
      method="post" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
    @csrf
    @if($article->exists) @method('PUT') @endif

    <div class="mb-3"><label class="form-label">Tiêu đề</label>
        <input name="title" class="form-control" value="{{ old('title', $article->title) }}"></div>
    <div class="mb-3"><label class="form-label">Tóm tắt</label>
        <textarea name="summary" rows="2" class="form-control">{{ old('summary', $article->summary) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Nội dung</label>
        <textarea name="content" rows="10" class="form-control">{{ old('content', $article->content) }}</textarea></div>
    <div class="row">
        <div class="col-md-4 mb-3"><label class="form-label">Chuyên mục</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('category_id', $article->category_id) == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select></div>
        <div class="col-md-4 mb-3"><label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="published" @selected(old('status', $article->status) === 'published')>Đăng ngay</option>
                <option value="draft" @selected(old('status', $article->status) === 'draft')>Nháp</option>
            </select></div>
        <div class="col-md-4 mb-3"><label class="form-label">Ảnh đại diện</label>
            <input type="file" name="image" class="form-control" accept="image/*"></div>
    </div>
    @if($article->image)
        <img src="{{ $article->image_url }}" class="img-thumbnail mb-3" style="max-height:120px" alt="">
    @endif
    <button class="btn btn-danger">Lưu</button>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Hủy</a>
</form>
@endsection
