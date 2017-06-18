<?php

namespace App\Jobs;

use Digitec\Dto\CreateUserRequest;
use Illuminate\Support\Facades\Mail;

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
        $this->createUserRequest = $createUserRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->createUserRequest->getEmail())
            ->send(
                app()->makeWith(
                    'App\Mail\NewUserActivation',
                    ['userRequest' => $this->createUserRequest]
                )
            );
    }
}
