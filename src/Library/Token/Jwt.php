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

    const JWT_CONFIG_KEY       = 'JWT_KEY';
    const JWT_CONFIG_ISSUER    = 'JWT_ISSUER';
    const JWT_CONFIG_ID_LENGTH = 'JWT_ID_LENGTH';

    /**
     * @var string
     */
    protected $signingKey;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $audience;

    /**
     * TTL in minutes.
     *
     * @var int
     */
    protected $ttl = 30;

    /**
     * Jwt constructor.
     */
    public function __construct()
    {
        $this->setSigningKey($this->loadSigningKey());

        if (empty($this->signingKey)) {
            throw new \RuntimeException("missing signing key");
        }
    }

    /**
     * @return string
     */
    protected function loadSigningKey(): string
    {
        return base64_decode(getenv(self::JWT_CONFIG_KEY));
    }

    /**
     * @param int $ttl
     * @return Jwt
     */
    public function setTtl(int $ttl): Jwt
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * @param string $signingKey
     * @return Jwt
     */
    public function setSigningKey(string $signingKey): Jwt
    {
        $this->signingKey = $signingKey;
        return $this;
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
        $algorithm = new Hs256($this->signingKey);
        return $jwt->serialize($token, Factory::create($algorithm));
    }

    /**
     * @return TokenContainer
     */
    protected function createCommonToken(): TokenContainer
    {
        $now = new \DateTime();
        $expirationTime = new \DateTime($this->ttl . ' minutes');

        $token = new TokenContainer();
        $token->addClaim(new Claim\IssuedAt($now));
        $token->addClaim(new Claim\Expiration($expirationTime));
        $token->addClaim(new Claim\JwtId(Str::random(getenv(self::JWT_CONFIG_ID_LENGTH))));
        $token->addClaim(new Claim\Issuer(getenv(self::JWT_CONFIG_ISSUER)));
        $token->addClaim(new Claim\NotBefore($now));
        return $token;
    }

}