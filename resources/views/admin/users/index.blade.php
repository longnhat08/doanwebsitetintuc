@extends('layouts.admin')
@section('title', 'Người dùng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Người dùng</h3>
    <a href="{{ route('admin.users.create') }}" class="btn btn-danger">+ Thêm người dùng</a>
</div>
<div class="table-responsive bg-white shadow-sm rounded">
<table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>#</th><th>Tên</th><th>Email</th><th>Vai trò</th><th>Số bài</th><th></th></tr></thead>
    <tbody>
    @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td><td>{{ $u->name }}</td><td>{{ $u->email }}</td>
            <td>{{ $u->role === 'admin' ? 'Quản trị viên' : 'Biên tập viên' }}</td><td>{{ $u->articles_count }}</td>
            <td class="text-end">
                <form action="{{ route('admin.users.destroy', $u) }}" method="post" onsubmit="return confirm('Xóa người dùng này?')">
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
