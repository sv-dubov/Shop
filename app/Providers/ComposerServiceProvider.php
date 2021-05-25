<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout.partial.roots', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('layout.partial.brands', function($view) {
            $view->with(['items' => Brand::popular()]);
        });
        View::composer('layout.site', function($view) {
            $view->with(['positions' => Basket::getBasket()->products->count()]);
        });
        View::composer('layout.site', function($view) {
            $view->with(['positions' => Basket::getCount()]);
        });
    }
}
