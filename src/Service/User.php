<?php
namespace Digitec\Service;

use Digitec\Exception\EmailExists as EmailExistsException;

class User
{
    public function create(string $email): bool
    {
        throw new EmailExistsException();
    }
}