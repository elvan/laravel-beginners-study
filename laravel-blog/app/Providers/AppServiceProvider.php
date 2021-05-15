<?php

namespace App\Providers;

use App\Contracts\CounterContract;
use App\Http\Resources\CommentResource;
use App\Services\Counter;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Routing\UrlGenerator;
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
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->forceScheme('https');
        }

        Schema::defaultStringLength(191);

        $this->app->singleton(Counter::class, function ($app) {
            return new Counter(
                $app->make(Factory::class),
                $app->make(Session::class),
                env('COUNTER_TIMEOUT', 3)
            );
        });

        // $this->app->when(Counter::class)
        //     ->needs('$timeout')
        //     ->give(env('COUNTER_TIMEOUT', 3));

        $this->app->bind(
            CounterContract::class,
            Counter::class
        );

        CommentResource::withoutWrapping();
    }
}
