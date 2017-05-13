<?php
namespace Digitec\Dto;

/**
 * Class CreateUserRequest
 * @package Digitec\Dto
 */
class CreateUserRequest
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @param string $email
     * @return CreateUserRequest
     */
    public function setEmail(string $email): CreateUserRequest
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}