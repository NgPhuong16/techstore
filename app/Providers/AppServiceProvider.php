<?php

namespace App\Providers;

use App\Models\Category;
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
        view()->composer('*', function($view){
            // $categories = Category::all();
            $categories = Category::where('status', 1)->get();
            $view->with(compact('categories')); //Hiển thị categories ở các view
        });
    }
}
