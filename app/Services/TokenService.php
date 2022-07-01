<?php

namespace App\Service;


class TokenService
{
    private string $secret;

    public function __construct()
    {
        $this->secret = TOKEN_SECRET;
    }
       
    /**
     * generate JWT token 
     *
     * @param  mixed $userId
     * @return string
     */
    public function generate($userId): string
    {       
        $expiration = time() + TOKEN_EXPIRE;
        return Token::create($userId, $this->secret, $expiration, TOKEN_ISSUER);
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