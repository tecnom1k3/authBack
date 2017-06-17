<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue; //TODO: queue emails instead of sending sync
use Digitec\Dto\CreateUserRequest;
use Digitec\Service\Token as TokenService;
use Digitec\Dto\GetJwtRequest;

class NewUserActivation extends Mailable
{
    use Queueable, SerializesModels;

    const AUDIENCE_TOKEN = 'new_user';
    const VIEW           = 'emails.user.activation';
    const TOKEN_TTL      = 30;

    /**
     * @var CreateUserRequest
     */
    protected $userRequest;

    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * NewUserActivation constructor.
     * @param CreateUserRequest $userRequest
     * @param TokenService $tokenService
     */
    public function __construct(CreateUserRequest $userRequest, TokenService $tokenService)
    {
        $this->userRequest = $userRequest;
        $this->tokenService = $tokenService;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->userRequest->getEmail();

        $jwtRequest = new GetJwtRequest;
        $jwtRequest->setTtl(self::TOKEN_TTL)
            ->setSubject($email)
            ->setAudience(self::AUDIENCE_TOKEN);

        return $this->view(self::VIEW)->with([
            'email' => $email,
            'token' => $this->tokenService->getJwtToken($jwtRequest),
        ]);
    }
}
