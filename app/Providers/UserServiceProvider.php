<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Digitec\Service\User;
use Digitec\Dao\User as UserDao;

/**
 * Class UserServiceProvider
 * @package App\Providers
 */
class UserServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @var UserDao
     */
    protected $userDao;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User::class, function($app){
            return new User($this->userDao, $app);
        });
    }

    public function boot(UserDao $dao)
    {
        $this->userDao = $dao;
    }
}
