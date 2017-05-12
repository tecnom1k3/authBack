<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Digitec\Service\User as UserService;
use Digitec\Exception\MissingParameter;

class User extends Controller 
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function getAll() : JsonResponse
    {
        //TODO: this should throw an exception
        abort(401);
    }
  
    public function create(Request $request) : JsonResponse
    {
        if ($request->has('email')) {
            return response()->json([
                'status' => $this->userService->create($request->input('email'))
            ]);
        }
        
        throw new MissingParameter(MissingParameter::buildParameterList(['email']));
    }
}