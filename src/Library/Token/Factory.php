<?php

namespace Digitec\Library\Token;


class Factory
{
    const TYPE_JWT    = 'Jwt';
    const TYPE_RANDOM = 'Random';

    public static function get(string $type): TokenInterface
    {
        $class = 'Digitec\Library\Token\\' . $type;
        if (class_exists($class)) {
            return new $class;
        }
        throw new \InvalidArgumentException('Class not found: ' . $class);
    }
}