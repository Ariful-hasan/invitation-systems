<?php

namespace App\Controllers;
use ReallySimpleJWT\Token;
use App\Service\TokenService;


class HomeController 
{
    public function index(TokenService $tokenService)
    {
        // $userId = 1;
        // $secret = 'sec!ReT423*&';
        // $expiration = time() + 3600;
        // $issuer = 'localhost';
        // $token = Token::create($userId, $secret, $expiration, $issuer);
        // dump($token);
        // dump(Token::validate($token, $secret));
        
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoxMiwiZXhwIjoxNjU2NDMyNTU4LCJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTY0Mjg5NTl9.0LcD-RqqbSXBoDnfrrHKccpab8mwrhlOyvuX5ElOryc";
        // dump($token);
        // dump(Token::validate($token, $secret));


        $test = (int) time() + 3600;
        dump($test);
        dump($_ENV);
        $test = Token::getPayload($token);
        dump($test);
        // dump(TOKEN_SECRET);
    }
}