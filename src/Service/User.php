<?php
namespace Digitec\Service;

use Digitec\Exception\EmailExists as EmailExistsException;
use Digitec\Dto\CreateUserRequest;
use Digitec\Dao\User as UserDao;
use Illuminate\Support\Facades\Queue;
use Laravel\Lumen\Application;
use Illuminate\Support\Facades\Log;

/**
 * Class User
 * @package Digitec\Service
 */
class User
{
    /**
     * @var UserDao
     */
    protected $userDao;

    /**
     * @var Application
     */
    protected $app;

    public function __construct(UserDao $dao, Application $application)
    {
        $this->userDao = $dao;
        $this->app = $application;
    }

    /**
     * @param CreateUserRequest $userRequest
     * @return bool
     * @throws EmailExistsException
     */
    public function create(CreateUserRequest $userRequest): bool
    {
        Log::info('Attempting to create user with email [' . $userRequest->getEmail() . '] in ' . self::class);
        if ($this->userDao->checkEmailExists($userRequest->getEmail())) {
            Log::error('Email provided [' . $userRequest->getEmail() . '] already exists in ' . self::class);
            throw new EmailExistsException($userRequest->getEmail());
        }
        $this->sendEmail($userRequest);
        return true;
    }

    /**
     * @param CreateUserRequest $userRequest
     */
    protected function sendEmail(CreateUserRequest $userRequest)
    {
        Log::info('Queueing activation email for [' . $userRequest->getEmail() . '] in ' . self::class);
        $mailQueue = $this->app->makeWith(
            'App\Jobs\SendActivationEmailQueue',
            [
                'createUserRequest' => $userRequest,
            ]
        );

        Queue::push($mailQueue);
    }
}