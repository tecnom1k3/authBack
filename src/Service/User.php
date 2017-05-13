<?php
namespace Digitec\Service;

use Digitec\Exception\EmailExists as EmailExistsException;
use Digitec\Dto\CreateUserRequest;

/**
 * Class User
 * @package Digitec\Service
 */
class User
{
    /**
     * @param CreateUserRequest $userRequest
     * @return bool
     * @throws EmailExistsException
     */
    public function create(CreateUserRequest $userRequest): bool
    {
        throw new EmailExistsException($userRequest->getEmail());
    }
}