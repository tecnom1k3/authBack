<?php

namespace App\Jobs;

use Digitec\Dto\CreateUserRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendActivationEmailQueue extends Job
{

    /**
     * @var CreateUserRequest
     */
    protected $createUserRequest;

    /**
     * SendActivationEmailQueue constructor.
     * @param CreateUserRequest $createUserRequest
     */
    public function __construct(CreateUserRequest $createUserRequest)
    {
        Log::info('Creating job for email [' . $createUserRequest->getEmail() . '] in ' . self::class);
        $this->createUserRequest = $createUserRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Sending activation email to [' . $this->createUserRequest->getEmail() . '] in ' . self::class);
        Mail::to($this->createUserRequest->getEmail())
            ->send(
                app()->makeWith(
                    'App\Mail\NewUserActivation',
                    ['userRequest' => $this->createUserRequest]
                )
            );
    }
}
