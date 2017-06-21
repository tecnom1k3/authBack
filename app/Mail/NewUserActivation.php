<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Digitec\Dto\CreateUserRequest;
use Digitec\Service\Token as TokenService;
use Illuminate\Support\Facades\Log;

class NewUserActivation extends Mailable
{

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
        Log::info('Building email message for [' . $this->userRequest->getEmail() . '] in ' . self::class);
        $email = $this->userRequest->getEmail();

        $jwtRequest = app()->make('Digitec\Dto\GetJwtRequest');
        $jwtRequest->setTtl(self::TOKEN_TTL)
            ->setSubject($email)
            ->setAudience(self::AUDIENCE_TOKEN);

        return $this->view(self::VIEW)->with([
            'email' => $email,
            'token' => $this->tokenService->getJwtToken($jwtRequest),
        ]);
    }
}
