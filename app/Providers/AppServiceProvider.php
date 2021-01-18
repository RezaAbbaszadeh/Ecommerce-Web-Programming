<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{


    public function __construct()
    {
    }

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
        $cats = Category::whereNull('parent_id')->get();
        View::Share('categories', $cats );
    }
}
