<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Digitec\Service\User as UserService;
use Digitec\Exception\MissingParameter;
use Digitec\Dto\CreateUserRequest;

/**
 * Class User
 * @package App\Http\Controllers
 */
class User extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * User constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function getAll() : JsonResponse
    {
        //TODO: this should throw an exception
        abort(401);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws MissingParameter
     */
    public function create(Request $request) : JsonResponse
    {
        if ($request->has('email')) {
            
            $createUserRequest = new CreateUserRequest;
            $createUserRequest->setEmail($request->input('email'));
            
            return response()->json([
                'status' => $this->userService->create($createUserRequest)
            ]);
        }
        
        throw new MissingParameter(MissingParameter::buildParameterList(['email']));
    }
}