@extends('layouts.admin')
@section('title', $category->exists ? 'Sửa chuyên mục' : 'Thêm chuyên mục')

@section('content')
<h3>{{ $category->exists ? 'Sửa chuyên mục' : 'Thêm chuyên mục' }}</h3>
<form action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
      method="post" class="bg-white p-4 shadow-sm rounded">
    @csrf
    @if($category->exists) @method('PUT') @endif
    <div class="mb-3"><label class="form-label">Tên chuyên mục</label>
        <input name="name" class="form-control" value="{{ old('name', $category->name) }}"></div>
    <div class="mb-3"><label class="form-label">Mô tả</label>
        <input name="description" class="form-control" value="{{ old('description', $category->description) }}"></div>
    <button class="btn btn-danger">Lưu</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Hủy</a>
</form>
@endsection
