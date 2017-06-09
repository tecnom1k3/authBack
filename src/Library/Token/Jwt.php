<?php

namespace Digitec\Library\Token;

use Emarref\Jwt\Algorithm\Hs256;
use Emarref\Jwt\Claim;
use Emarref\Jwt\Encryption\Factory;
use Emarref\Jwt\Jwt as JwtVendor;
use Emarref\Jwt\Token as TokenContainer;
use Illuminate\Support\Str;

class Jwt implements TokenInterface
{
    //TODO: create a composite pattern, to hold the structure of token, claims, and jwt

    const JWT_CONFIG_KEY = 'JWT_KEY';

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $audience;

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Jwt
     */
    public function setSubject(string $subject): Jwt
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getAudience(): string
    {
        return $this->audience;
    }

    /**
     * @param string $audience
     * @return Jwt
     */
    public function setAudience(string $audience): Jwt
    {
        $this->audience = $audience;
        return $this;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        if (empty($this->subject) || empty($this->audience)) {
            throw new \RuntimeException('No subject or audience set in ' . self::class);
        }

        $token = $this->createCommonToken();
        $token->addClaim(new Claim\Subject($this->subject));
        $token->addClaim(new Claim\Audience($this->audience));

        $jwt = new JwtVendor();
        $algorithm = new Hs256(base64_decode(getenv(self::JWT_CONFIG_KEY))); //TODO: validate that the JWT config key exists
        return $jwt->serialize($token, Factory::create($algorithm));
    }

    /**
     * @return TokenContainer
     */
    protected function createCommonToken(): TokenContainer
    {
        $token = new TokenContainer();
        $token->addClaim(new Claim\IssuedAt(new \DateTime('now')));
        $token->addClaim(new Claim\Expiration(new \DateTime('30 minutes')));
        $token->addClaim(new Claim\JwtId(Str::random(32)));
        $token->addClaim(new Claim\Issuer('awesome.dev'));
        $token->addClaim(new Claim\NotBefore(new \DateTime('now')));
        return $token;
    }

}