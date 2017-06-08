<?php

namespace Digitec\Service;

use Emarref\Jwt\Claim;
use Emarref\Jwt\Algorithm\Hs256;
use Illuminate\Support\Str;
use Emarref\Jwt\Encryption\Factory;
use Emarref\Jwt\Jwt;
use Digitec\Library\Token\Jwt\Token as TokenContainer;

class Token
{
    const JWT_CONFIG_KEY = 'JWT_KEY';

    //TODO: create a composite pattern, to hold the structure of token, claims, and jwt
    //TODO: Token should be different types, like JWT, random, others... create strategy pattern

    /**
     * @param string $subject
     * @param string $audience
     * @return string
     */
    public function getToken(string $subject, string $audience): string
    {
        $token = $this->createCommonToken();
        $token->addClaim(new Claim\Subject($subject))
            ->addClaim(new Claim\Audience($audience));

        $jwt = new Jwt();
        $algorithm = new Hs256(base64_decode(getenv(self::JWT_CONFIG_KEY))); //TODO: validate that the JWT config key exists
        return $jwt->serialize($token, Factory::create($algorithm));
    }

    /**
     * @return TokenContainer
     */
    protected function createCommonToken(): TokenContainer
    {
        $token = new TokenContainer();
        $token->addClaim(new Claim\IssuedAt(new \DateTime('now')))
            ->addClaim(new Claim\Expiration(new \DateTime('30 minutes')))
            ->addClaim(new Claim\JwtId(Str::random(32)))
            ->addClaim(new Claim\Issuer('awesome.dev'))
            ->addClaim(new Claim\NotBefore(new \DateTime('now')));
        return $token;
    }

}