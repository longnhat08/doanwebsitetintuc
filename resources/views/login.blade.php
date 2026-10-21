@extends('layouts.app')
@section('title', 'Đăng nhập')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="bg-white p-4 shadow-sm rounded">
            <h3>Đăng nhập</h3>
            @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('login.submit') }}" method="post">
                @csrf
                <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="{{ old('email') }}" autofocus></div>
                <div class="mb-3"><label class="form-label">Mật khẩu</label><input name="password" type="password" class="form-control"></div>
                <div class="form-check mb-3"><input type="checkbox" name="remember" value="1" class="form-check-input" id="remember"><label for="remember" class="form-check-label">Ghi nhớ đăng nhập</label></div>
                <button class="btn btn-danger w-100">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
@endsection
