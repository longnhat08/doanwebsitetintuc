@extends('layouts.admin')
@section('title', 'Liên hệ')

@section('content')
<h3>Liên hệ từ độc giả</h3>
<div class="table-responsive bg-white shadow-sm rounded">
<table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>Họ tên</th><th>Email</th><th>Chủ đề</th><th>Nội dung</th><th>Ngày gửi</th><th></th></tr></thead>
    <tbody>
    @forelse($contacts as $c)
        <tr>
            <td>{{ $c->name }}</td><td>{{ $c->email }}</td><td>{{ $c->subject }}</td>
            <td>{{ \Illuminate\Support\Str::limit($c->message, 80) }}</td>
            <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
            <td class="text-end">
                <form action="{{ route('admin.contacts.destroy', $c) }}" method="post" onsubmit="return confirm('Xóa liên hệ này?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted">Chưa có liên hệ.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="mt-3">{{ $contacts->links() }}</div>
@endsection
