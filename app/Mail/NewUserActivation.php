<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue; //TODO: queue emails instead of sending sync
use Digitec\Dto\CreateUserRequest;
use Digitec\Service\Token as TokenService;


class NewUserActivation extends Mailable
{
    use Queueable, SerializesModels;

    const AUDIENCE_TOKEN = 'new_user';
    const VIEW = 'emails.user.activation';

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
     */
    public function __construct(CreateUserRequest $userRequest)
    {
        $this->userRequest = $userRequest;
        $this->tokenService = new TokenService; //TODO: use DI instead of creating the object
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->userRequest->getEmail();

        return $this->view(self::VIEW)->with([
            'email' => $email,
            'token' => $this->tokenService->getJwtToken($email, self::AUDIENCE_TOKEN),
        ]);
    }
}
