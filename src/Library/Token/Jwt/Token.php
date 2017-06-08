<?php

namespace Digitec\Library\Token\Jwt;

use Emarref\Jwt\Claim;
use Emarref\Jwt\Token as TokenVendor;

class Token extends TokenVendor
{
    /**
     * @param Claim\ClaimInterface $claim
     * @return Token
     */
    public function addClaim(Claim\ClaimInterface $claim): Token
    {
        parent::addClaim($claim);
        return $this;
    }
}