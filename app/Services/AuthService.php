<?php

namespace App\Services;

use App\Core\Response;
use App\Facades\Token;
use App\Repositories\UserRepository;

class AuthService 
{
    public function __construct(protected UserRepository $userRepository, protected Response $response)
    {

    }

    public function login(array $request)
    {
        try {
            $request = [
                'email' => $request['email'],
                'password' => md5($request['password'])
            ];
            $user = $this->userRepository->find($request);
    
            if (!$user) {
                return $this->response->send(400, "Email or Password invalid!");
            }

            $token = Token::generate($user['id']);
            // var_dump($user['id']);
            // var_dump($this->userRepository->updateById($user['id'], ['token' => $token]));die;
            if ($this->userRepository->updateById($user['id'], ['token' => $token])) {
                return $this->response->send(200, "Successfully loggedin.", [
                    'userId' => $user['id'],
                    'userName' => $user['name'],
                    'userToken' => $token
                ]);
            }

            return $this->response->send(400, "Failed to logg in!");
        } catch (\Exception $e) {
            return $this->response->send(500, $e->getMessage());
        }  
    }
}