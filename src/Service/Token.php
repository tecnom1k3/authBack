<?php

namespace Digitec\Service;

use Digitec\Library\Token\Jwt;
use Digitec\Library\Token\Factory as TokenFactory;
use Digitec\Library\Token\Random;
use Digitec\Dto\GetJwtRequest;
use Digitec\Dto\RandomTokenRequest;
use Illuminate\Support\Facades\Log;

class Token
{
    /**
     * @param GetJwtRequest $jwtRequest
     * @return string
     */
    public function getJwtToken(GetJwtRequest $jwtRequest): string
    {
        Log::info('invoked [' . __FUNCTION__ . '] in [' . self::class . ']');
        /** @var Jwt $token */
        $token = TokenFactory::get(TokenFactory::TYPE_JWT);
        $token->setAudience($jwtRequest->getAudience())
            ->setSubject($jwtRequest->getSubject())
            ->setTtl($jwtRequest->getTtl());
        return $token->get();
    }

    /**
     * @param RandomTokenRequest $tokenRequest
     * @return string
     */
    public function getRandomToken(RandomTokenRequest $tokenRequest): string
    {
        Log::info('invoked [' . __FUNCTION__ . '] in [' . self::class . ']');
        /** @var Random $token */
        $token = TokenFactory::get(TokenFactory::TYPE_RANDOM);
        $token->setLength($tokenRequest->getLength())
            ->setKeySpace($tokenRequest->getKeySpace());
        return $token->get();
    }
}