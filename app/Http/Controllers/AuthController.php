<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController 
{
    public function __construct(protected AuthService $authService)
    {
        # code...
    }

    public function login()
    {
        $validated = (new LoginRequest())->validated();
        return $this->authService->login($validated);
    }
}