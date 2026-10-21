@extends('layouts.admin')
@section('title', 'Thêm người dùng')

@section('content')
<h3>Thêm người dùng</h3>
<form action="{{ route('admin.users.store') }}" method="post" class="bg-white p-4 shadow-sm rounded">
    @csrf
    <div class="mb-3"><label class="form-label">Họ tên</label><input name="name" class="form-control" value="{{ old('name') }}"></div>
    <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="{{ old('email') }}"></div>
    <div class="row">
        <div class="col-md-6 mb-3"><label class="form-label">Mật khẩu</label><input name="password" type="password" class="form-control"></div>
        <div class="col-md-6 mb-3"><label class="form-label">Nhập lại mật khẩu</label><input name="password_confirmation" type="password" class="form-control"></div>
    </div>
    <div class="mb-3"><label class="form-label">Vai trò</label>
        <select name="role" class="form-select">
            <option value="editor">Biên tập viên</option>
            <option value="admin">Quản trị viên</option>
        </select></div>
    <button class="btn btn-danger">Lưu</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Hủy</a>
</form>
@endsection
