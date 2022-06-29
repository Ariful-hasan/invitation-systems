<?php

namespace App\Controllers;

use App\Controllers\TestInterface;

class TestController implements TestInterface
{
    public function hello()
    {
        dump("hello world!!!!!");
    }
}