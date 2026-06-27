<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            $hasDb = true;
        } catch (\Throwable) {
            $hasDb = false;
        }

        View::composer('layouts.frontend', function ($view) use ($hasDb) {
            $categories = collect();
            if ($hasDb) {
                try {
                    $categories = Category::where('status', 'active')
                        ->orderBy('display_order')
                        ->orderBy('name')
                        ->get(['id', 'name', 'slug']);
                } catch (\Throwable) {}
            }
            $view->with('navCategories', $categories);
        });
    }
}
