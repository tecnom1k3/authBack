<?php
namespace Digitec\Exception;

class EmailExists extends Exception
{
    protected $message = 'Email already exists.';
    protected $code    = 409;
}