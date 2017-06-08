<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Digitec\Dao\User;

/**
 * Class UserDaoProvider
 * @package App\Providers
 */
class UserDaoProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User::class, function ($app) {
            return new User();
        });
    }
}
