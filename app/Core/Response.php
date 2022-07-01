<?php

namespace App\Core;

use App\Core\Contracts\ResponseContract;

class Response implements ResponseContract
{
    public function send($status=400, $status_message='', $data=[])
    {
        header("HTTP/1.1 ".$status);
        
        $response['status']=$status;
        $response['message']=$status_message;
        $response['data']=$data;
        
        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }
}