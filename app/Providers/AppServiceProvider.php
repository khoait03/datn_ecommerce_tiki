<?php

namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


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
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            if (auth()->check()) {
                $wishlistItems = Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray();
                $view->with('wishlistItems', $wishlistItems);
            }
        });

    }
}
