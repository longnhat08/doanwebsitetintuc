<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Menu chuyên mục dùng chung cho layout công khai
        View::composer('layouts.app', function ($view) {
            $view->with('menuCategories', Category::orderBy('name')->get());
        });
    }
}
