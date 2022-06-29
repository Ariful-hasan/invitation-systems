<?php

namespace App\Controllers;


use App\Controllers\TestInterface;
use App\Controllers\TestController;
use App\Core\Request;
use App\Facades\Token;

class HomeController 
{
    public function __construct(public TestInterface $testController)
    {
        # code...
    }
    public function index(Request $request)
    {
        // $userId = 1;
        // $secret = 'sec!ReT423*&';
        // $expiration = time() + 3600;
        // $issuer = 'localhost';
        // $token = Token::create($userId, $secret, $expiration, $issuer);
        // dump($token);
        // dump(Token::validate($token, $secret));
        
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoxLCJleHAiOjE2NTY1MDg2MTMsImlzcyI6ImxvY2FsaG9zdCIsImlhdCI6MTY1NjUwNTAxM30.5FpxiNuaJazZ_czwp2hFtDHZnfvhZ9Ew2aimro4J0Bk";
        // dump($token);
        dump(Token::validate($token));


        // $test = (int) time() + 3600;
        // dump($test);
        // dump($_ENV);
        // $test = Token::getPayload($token);
        // dump($test);
        // dump(TOKEN_SECRET);
        // dump(Token::generate(1));

    }

    public function testpost(Request $request)
    {
        return $request->getBody();
    }
}