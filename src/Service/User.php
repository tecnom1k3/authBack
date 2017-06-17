<?php
namespace Digitec\Service;

use Digitec\Exception\EmailExists as EmailExistsException;
use Digitec\Dto\CreateUserRequest;
use Digitec\Dao\User as UserDao;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserActivation;
use Laravel\Lumen\Application;

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
        if ($this->userDao->checkEmailExists($userRequest->getEmail())) {
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
        Mail::to($userRequest->getEmail())
            ->send(
                $this->app->makeWith(
                    'App\Mail\NewUserActivation',
                    ['userRequest' => $userRequest]
                )
            );
    }
}