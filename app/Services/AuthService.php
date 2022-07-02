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
    
    /**
     * login user
     * return user info and JWT token
     *
     * @param  mixed $request
     * @return void
     */
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
    
    /**
     * logout user
     * update user token set as empty
     * 
     * @param  mixed $request
     * @return void
     */
    public function logout(array $request)
    {
        try {
            if (!Token::validate($request['token'])) {
                return $this->response->send(401, "Invalid Token!");
            }

            $payload = Token::decode($request['token']);
            
            if (($request['id'] !== $payload['user_id']) || !$this->userRepository->find($request)) {
                return $this->response->send(401, "Invalid User Information!");
            }

            if (!$this->userRepository->updateById($request['id'], ['token' => ''])) {
                return $this->response->send(404, "Failed to Logout!");
            }

            return $this->response->send(200, "Successfully Logout.");
        } catch (\Exception $e) {
            return $this->response->send(500, $e->getMessage());
        }
    }
}