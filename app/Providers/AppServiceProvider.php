<?php

namespace App\Providers;

use App\Models\Tag;
use App\View\Components\Admin;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        view()->composer('layouts.sidebar', function (View $view) {
            $view->with('tags', Tag::all());
        });

        Blade::component('admin', Admin::class);
    }
}
