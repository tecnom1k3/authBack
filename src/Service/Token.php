<?php

namespace Digitec\Service;

use Digitec\Library\Token\Jwt;
use Digitec\Library\Token\Factory as TokenFactory;
use Digitec\Library\Token\Random;

class Token
{
    /**
     * @param string $subject
     * @param string $audience
     * @return string
     */
    public function getJwtToken(string $subject, string $audience): string
    {
        /** @var Jwt $token */
        $token = TokenFactory::get(TokenFactory::TYPE_JWT);
        $token->setAudience($audience)
            ->setSubject($subject);
        return $token->get();
    }

    /**
     * @param int $length
     * @param string $keySpace
     * @return string
     */
    public function getRandomToken(int $length, string $keySpace): string
    {
        /** @var Random $token */
        $token = TokenFactory::get(TokenFactory::TYPE_RANDOM);
        $token->setLength($length)
            ->setKeySpace($keySpace);
        return $token->get();
    }
}