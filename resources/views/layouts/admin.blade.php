<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Quản trị') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Quản trị</a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.articles.index') }}">Bài viết</a></li>
            @if(auth()->user()->isAdmin())
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">Chuyên mục</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.comments.index') }}">Bình luận</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.contacts.index') }}">Liên hệ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Người dùng</a></li>
            @endif
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" target="_blank">Xem trang web</a></li>
        </ul>
        <span class="navbar-text me-3">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
        <form action="{{ route('logout') }}" method="post">@csrf
            <button class="btn btn-outline-light btn-sm">Đăng xuất</button>
        </form>
    </div>
</nav>

<main class="container my-4">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
