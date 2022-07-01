<?php

namespace App\Services;

use App\Core\Response;
use App\Repositories\UserRepository;

class UserService 
{
    public function __construct(private UserRepository $userRepository, protected Response $response)
    {

    }

    public function create(array $request)
    {
        try {
            if ($this->userRepository->find(['email' => $request['email']])) {
                return $this->response->send(400, "This email already exist!");
            }

            // hashing password
            $request['password'] = md5($request['password']);

            if ($this->userRepository->create($request)) {
                return $this->response->send(200, "User successfully created.");
            }

            return $this->response->send(400, "Failed to create user!");
        } catch (\Exception $e) {
            return $this->response->send(500, $e->getMessage());
        }
    }
}