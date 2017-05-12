<?php
namespace Digitec\Service;

use Digitec\Exception\EmailExists as EmailExistsException;
use Digitec\Dto\CreateUserRequest;

class User
{
    public function create(CreateUserRequest $userRequest): bool
    {
        throw new EmailExistsException($userRequest->getEmail());
    }
}