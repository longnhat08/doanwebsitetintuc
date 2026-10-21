@extends('layouts.admin')
@section('title', 'Tổng quan')

@section('content')
<h3>Xin chào, {{ auth()->user()->name }}</h3>
<div class="row g-3 mt-1">
    @foreach($stats as $label => $value)
        <div class="col-6 col-lg-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="display-6">{{ $value }}</div>
                    <div class="text-muted">{{ $label }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
