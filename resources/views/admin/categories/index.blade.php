@extends('layouts.admin')
@section('title', 'Chuyên mục')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Chuyên mục</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-danger">+ Thêm chuyên mục</a>
</div>
<div class="table-responsive bg-white shadow-sm rounded">
<table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>#</th><th>Tên</th><th>Slug</th><th>Số bài</th><th></th></tr></thead>
    <tbody>
    @foreach($categories as $c)
        <tr>
            <td>{{ $c->id }}</td><td>{{ $c->name }}</td><td>{{ $c->slug }}</td><td>{{ $c->articles_count }}</td>
            <td class="text-end text-nowrap">
                <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                <form action="{{ route('admin.categories.destroy', $c) }}" method="post" class="d-inline" onsubmit="return confirm('Xóa chuyên mục này?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
