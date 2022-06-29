<?php

namespace App\Auth;

use ReallySimpleJWT\Token;

class AuthToken
{
    private string $secret;

    public function __construct()
    {
        $this->secret = $_ENV['TOKEN_SECRET'];
    }
       
    /**
     * generate JWT token 
     *
     * @param  mixed $userId
     * @return string
     */
    public function generate($userId): string
    {       
        try {
            $expiration = time() + $_ENV['TOKEN_EXPIRE'];
        return Token::create($userId, $this->secret, $expiration, $_ENV['TOKEN_ISSUER']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
  
    /**
     * validate JWT token
     *
     * @param  mixed $token
     * @return bool
     */
    public function validate($token): bool
    {
        return Token::validate($token, $this->secret);
    }
}