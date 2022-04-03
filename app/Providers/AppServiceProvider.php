<?php

namespace App\Providers;

use App\Product;
use App\Category;
use App\Observers\Product as ObserverProduct;
use App\Observers\Category as ObserverCategory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ObserverProduct::class);
        Category::observe(ObserverCategory::class);
    }
}
