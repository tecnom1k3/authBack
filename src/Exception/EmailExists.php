<?php
namespace Digitec\Exception;

/**
 * Class EmailExists
 * @package Digitec\Exception
 */
class EmailExists extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Email already exists: ';

    /**
     * @var int
     */
    protected $code = 409;

    /**
     * EmailExists constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->message .= $email;
    }
}