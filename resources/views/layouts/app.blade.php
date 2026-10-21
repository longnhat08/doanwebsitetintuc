<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .brand { font-weight: 700; letter-spacing: .5px; }
        .card-img-top { height: 180px; object-fit: cover; }
        .hero-img { height: 340px; object-fit: cover; width: 100%; }
        .article-body { font-size: 1.1rem; line-height: 1.8; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Trang chủ</a></li>
                @foreach($menuCategories as $c)
                    <li class="nav-item"><a class="nav-link" href="{{ route('category', $c->slug) }}">{{ $c->name }}</a></li>
                @endforeach
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên hệ</a></li>
            </ul>
            <form class="d-flex me-3" action="{{ route('search') }}" method="get">
                <input class="form-control form-control-sm me-2" type="search" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm...">
                <button class="btn btn-light btn-sm">Tìm</button>
            </form>
            @auth
                <a class="btn btn-outline-light btn-sm" href="{{ route('admin.dashboard') }}">Quản trị</a>
            @else
                <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Đăng nhập</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container my-4">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>

<footer class="bg-dark text-light py-3 mt-5">
    <div class="container small">&copy; {{ date('Y') }} {{ config('app.name') }} - Bài tập môn Lập trình Web</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
