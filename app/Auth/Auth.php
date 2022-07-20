<?php

namespace App\Auth;

use App\Facades\Token;
use App\Repositories\UserRepository;
use App\Models\User;

trait Auth 
{
    public function auth (array $request)
    {
        try {
            $userRepository = new UserRepository(new User());

            if (!isset($request['token']) || !isset($request['id']) || !Token::validate($request['token'])) {
                return $this->response->send(401, "Invalid Request!");
            }
    
            $payload = Token::decode($request['token']);

            if (($request['id'] !== $payload['user_id']) || !$userRepository->find(['id'=>$request['id'], 'token'=>$request['token']])) {
                return $this->response->send(401, "Invalid User Information!");
            }

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}