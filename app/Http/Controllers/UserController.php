<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController 
{        
    public function __construct(protected UserService $userService)
    {
        
    }
        
    /**
     * create
     *
     * @param  mixed $userRequest
     * @return void
     */
    public function create()
    {
        $request = new UserRequest();
        return $this->userService->create($request->validated());
    }
}