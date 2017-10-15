<?php
/**
 * Created by PhpStorm.
 * User: miibarra
 * Date: 6/9/17
 * Time: 10:05 PM
 */

namespace Digitec\Dto;


class RandomTokenRequest
{

    /**
     * @var int
     */
    protected $length;

    /**
     * @var string
     */
    protected $keySpace;

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return RandomTokenRequest
     */
    public function setLength(int $length): RandomTokenRequest
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeySpace(): string
    {
        return $this->keySpace;
    }

    /**
     * @param string $keySpace
     * @return RandomTokenRequest
     */
    public function setKeySpace(string $keySpace): RandomTokenRequest
    {
        $this->keySpace = $keySpace;
        return $this;
    }

}