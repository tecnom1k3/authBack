<?php
namespace Digitec\Exception;

/**
 * Class MissingParameter
 * @package Digitec\Exception
 */
class MissingParameter extends Exception
{
    /**
     * @var int
     */
    protected $code = 400;

    /**
     * @param array $parameterList
     * @return string
     */
    public static function buildParameterList(array $parameterList): string
    {
        return implode(', ', $parameterList);
    }

    /**
     * MissingParameter constructor.
     * @param string $parameterList
     */
    public function __construct(string $parameterList)
    {
        $this->message = 'Missing parameters from request: ' . $parameterList;
    }
}