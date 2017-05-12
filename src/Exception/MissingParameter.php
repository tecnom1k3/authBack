<?php
namespace Digitec\Exception;

class MissingParameter extends Exception
{
    protected $code = 400;
    
    public static function buildParameterList(array $parameterList): string
    {
        return implode(', ', $parameterList);
    }
    
    public function __construct(string $parameterList)
    {
        $this->message = 'Missing parameters from request: ' . $parameterList;
    }
}