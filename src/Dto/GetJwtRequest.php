<?php
namespace Digitec\Dto;


class GetJwtRequest
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $audience;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return GetJwtRequest
     */
    public function setSubject(string $subject): GetJwtRequest
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
     * @return GetJwtRequest
     */
    public function setAudience(string $audience): GetJwtRequest
    {
        $this->audience = $audience;
        return $this;
    }

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     * @return GetJwtRequest
     */
    public function setTtl(int $ttl): GetJwtRequest
    {
        $this->ttl = $ttl;
        return $this;
    }
}