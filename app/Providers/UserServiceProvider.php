<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Digitec\Service\User;

class UserServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User::class, function($app){
            return new User();
        });
    }
}
