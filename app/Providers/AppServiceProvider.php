<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrap();

        Blade::directive('icon', function($expression) {
            $name = str_replace("'", '', $expression);
            return '<i class="fas fa-' . $name . '"></i>';
        });
        Blade::directive('price', function($expression) {
            return "<?php echo number_format($expression, 2, '.', ''); ?>";
        });
        Blade::if('admin', function() {
            return ! auth()->check() && auth()->user()->admin;
        });
    }
}
