<?php
namespace Digitec\Dto;

class CreateUserRequest
{
    protected $email;
    
    public function setEmail(string $email): CreateUserRequest
    {
        $this->email = $email;
        return $this;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
}