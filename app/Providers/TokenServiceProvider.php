<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Digitec\Service\Token;

class TokenServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

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
        $this->app->singleton(
            Token::class,
            function ($app) {
                return new Token;
            }
        );
    }
}
