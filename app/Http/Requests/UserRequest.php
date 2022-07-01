<?php

namespace App\Http\Requests;

use App\Core\Request;
use App\Core\Response;

class UserRequest extends Request
{        
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * validate post data
     * @override
     * @return array
     */
    public function validated(): array
    {
        $data = $this->getBody();

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->response->send(400, "Email is not valid!");
        }

        if (strlen($data['password']) < 4 || strlen($data['password']) > 8) {
            return $this->response->send(400, "Password is not valid!");
        }

        if (strlen($data['name']) < 1 || strlen($data['password']) > 20) {
            return $this->response->send(400, "Name is not valid!");
        }

        $data = [
            'email' => $data['email'],
            'password' => $data['password'],
            'name' => $data['name'],
        ];

        return $data;
    }
}