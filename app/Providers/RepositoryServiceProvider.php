<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\CategoryRepositoryInterface', function () {
            return new \App\Repositories\Eloquents\CategoryRepository(\App\Models\Category::class);
        });

        $this->app->bind('App\Repositories\Contracts\WordRepositoryInterface', function () {
            return new \App\Repositories\Eloquents\WordRepository(\App\Models\Word::class);
        });
    }
}
