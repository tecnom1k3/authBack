<?php

namespace Digitec\Library\Token;


class Random implements TokenInterface
{
    const KEY_SPACE_ALPHA_NUM = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVWXYZ1234567890';

    /**
     * @var integer
     */
    protected $length;

    /**
     * @var string
     */
    protected $keySpace;

    /**
     * @return string
     */
    public function getKeySpace(): string
    {
        return $this->keySpace;
    }

    /**
     * @param string $keySpace
     * @return Random
     */
    public function setKeySpace(string $keySpace): Random
    {
        $this->keySpace = $keySpace;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return Random
     */
    public function setLength(int $length): Random
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        if ($this->length > 0 && !empty($this->keySpace)) {
            $str = '';
            $keysize = strlen($this->keySpace);
            for ($i = 0; $i < $this->length; ++$i) {
                $str .= $this->keySpace[\Sodium\randombytes_uniform($keysize)];
            }
            return $str;
        }

        throw new \InvalidArgumentException('Invalid token length or key space provided');
    }
}