<?php

namespace App\Http\Requests;

use App\Core\Request;

class LoginRequest extends Request
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

        if (strlen($data['password']) < 1 || strlen($data['password']) > 20) {
            return $this->response->send(400, "Name is not valid!");
        }

        $data = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        return $data;
    }
}