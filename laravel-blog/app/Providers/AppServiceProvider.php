<?php

namespace App\Providers;

use App\Services\Counter;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        // $this->app->singleton(Counter::class, function ($app) {
        //     return new Counter(env('COUNTER_TIMEOUT', 3));
        // });

        $this->app->when(Counter::class)
            ->needs('$timeout')
            ->give(env('COUNTER_TIMEOUT', 3));
    }
}
