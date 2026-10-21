@extends('layouts.admin')
@section('title', 'Bình luận')

@section('content')
<h3>Duyệt bình luận</h3>
<div class="table-responsive bg-white shadow-sm rounded">
<table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>Người gửi</th><th>Nội dung</th><th>Bài viết</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
    @forelse($comments as $c)
        <tr>
            <td>{{ $c->author_name }}</td>
            <td>{{ $c->content }}</td>
            <td>{{ \Illuminate\Support\Str::limit($c->article->title, 40) }}</td>
            <td><span class="badge {{ $c->is_approved ? 'bg-success' : 'bg-warning text-dark' }}">{{ $c->is_approved ? 'Đã duyệt' : 'Chờ duyệt' }}</span></td>
            <td class="text-end text-nowrap">
                @unless($c->is_approved)
                    <form action="{{ route('admin.comments.approve', $c) }}" method="post" class="d-inline">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm btn-outline-success">Duyệt</button>
                    </form>
                @endunless
                <form action="{{ route('admin.comments.destroy', $c) }}" method="post" class="d-inline" onsubmit="return confirm('Xóa bình luận này?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center text-muted">Chưa có bình luận.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="mt-3">{{ $comments->links() }}</div>
@endsection
