<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Services\AuthService;

class AuthController 
{
    public function __construct(protected AuthService $authService)
    {
        # code...
    }
    
    /**
     * login 
     *
     * @return void
     */
    public function login()
    {
        $validated = (new LoginRequest())->validated();
        return $this->authService->login($validated);
    }

    public function logout()
    {
        $validated = (new LogoutRequest())->validated();
        return $this->authService->logout($validated);
    }
}