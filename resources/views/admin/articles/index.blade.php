@extends('layouts.admin')
@section('title', 'Bài viết')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Bài viết</h3>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-danger">+ Thêm bài viết</a>
</div>
<div class="table-responsive bg-white shadow-sm rounded">
<table class="table table-hover align-middle mb-0">
    <thead class="table-light">
        <tr><th>#</th><th>Tiêu đề</th><th>Chuyên mục</th><th>Tác giả</th><th>Trạng thái</th><th>Lượt xem</th><th></th></tr>
    </thead>
    <tbody>
    @forelse($articles as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ \Illuminate\Support\Str::limit($a->title, 60) }}</td>
            <td>{{ $a->category->name }}</td>
            <td>{{ $a->user->name }}</td>
            <td><span class="badge {{ $a->status === 'published' ? 'bg-success' : 'bg-secondary' }}">{{ $a->status === 'published' ? 'Đã đăng' : 'Nháp' }}</span></td>
            <td>{{ $a->views }}</td>
            <td class="text-end text-nowrap">
                @if(auth()->user()->isAdmin() || $a->user_id === auth()->id())
                    <a href="{{ route('admin.articles.edit', $a) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form action="{{ route('admin.articles.destroy', $a) }}" method="post" class="d-inline" onsubmit="return confirm('Xóa bài viết này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center text-muted">Chưa có bài viết.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="mt-3">{{ $articles->links() }}</div>
@endsection
