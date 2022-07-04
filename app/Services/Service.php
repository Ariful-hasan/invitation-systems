<?php

namespace App\Services;

use App\Core\Response;

class Service 
{
    protected Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }
}