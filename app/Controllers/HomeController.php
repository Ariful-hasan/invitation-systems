<?php

namespace App\Controllers;


use App\Controllers\TestInterface;
use App\Controllers\TestController;
use App\Core\Request;

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
        
        // $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoxMiwiZXhwIjoxNjU2NDMyNTU4LCJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTY0Mjg5NTl9.0LcD-RqqbSXBoDnfrrHKccpab8mwrhlOyvuX5ElOryc";
        // dump($token);
        // dump(Token::validate($token, $secret));


        // $test = (int) time() + 3600;
        // dump($test);
        // dump($_ENV);
        // $test = Token::getPayload($token);
        // dump($test);
        // dump(TOKEN_SECRET);
        dump($request->getBody());
        $this->testController->hello();
    }

    public function testpost(Request $request)
    {
        return $request->getBody();
    }
}