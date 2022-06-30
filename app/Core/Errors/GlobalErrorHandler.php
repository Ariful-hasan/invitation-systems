<?php

namespace App\Core\Errors;

use App\Core\Response;

class GlobalErrorHandler
{
    public static function handle(int $errNo, string $errMsg, string $file, int $line)
    {
        return (new Response())->send(500, $errMsg);
    }
}