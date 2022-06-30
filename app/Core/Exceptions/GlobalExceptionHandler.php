<?php

namespace App\Core\Exceptions;

use Exception;
use App\Core\Response;

class GlobalExceptionHandler 
{
    public static function handle(Exception $e)
    {
        return (new Response())->send(500, $e->getMessage());
    }
}