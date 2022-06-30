<?php

namespace App\Core\Exceptions;

use Exception;

class GlobalExceptionHandler 
{
    public static function handle(Exception $e)
    {
        header("HTTP/1.1 500");
        $response['status']=500;
        $response['status_message']=$e->getMessage();
        $json_response = json_encode($response);
        echo $json_response;
    }
}