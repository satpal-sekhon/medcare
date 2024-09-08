<?php

namespace App\Providers;

use App\Models\PrimaryCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom');

        View::composer('layouts.frontend-layout', function ($view) {
            $menuPrimaryCategories = PrimaryCategory::with(['categories' => function($query) {
                $query->latest()->limit(16);
            }])->latest()->limit(6)->get();

            $view->with('menuPrimaryCategories', $menuPrimaryCategories);
        });
    }
}
