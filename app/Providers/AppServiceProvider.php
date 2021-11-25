<?php

namespace App\Providers;

use App\Models\Tag;
use App\View\Components\Admin;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use platx\pushall\PushAll;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PushAll::class, function () {
            return new PushAll(config('pushall.id'), config('pushall.key'));
        });
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
        Paginator::defaultView('pagination::default');
    }
}
