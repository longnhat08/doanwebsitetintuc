@extends('layouts.app')
@section('title', 'Liên hệ')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="bg-white p-4 shadow-sm rounded">
            <h3>Liên hệ</h3>
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                <div class="mb-3"><label class="form-label">Họ tên</label><input name="name" class="form-control" value="{{ old('name') }}"></div>
                <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="{{ old('email') }}"></div>
                <div class="mb-3"><label class="form-label">Chủ đề</label><input name="subject" class="form-control" value="{{ old('subject') }}"></div>
                <div class="mb-3"><label class="form-label">Nội dung</label><textarea name="message" rows="5" class="form-control">{{ old('message') }}</textarea></div>
                <button class="btn btn-danger">Gửi liên hệ</button>
            </form>
        </div>
    </div>
</div>
@endsection
