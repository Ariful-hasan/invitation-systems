<?php

namespace App\Http\Requests;

use App\Core\Request;

class LogoutRequest extends Request
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
        $token = $this->getBearerToken();
        
        if (!filter_var($data['user_id'], FILTER_VALIDATE_INT)) {
            return $this->response->send(400, "Invalid User Information!");
        }

        if (strlen($token) == 0) {
            return $this->response->send(400, "Invalid Credentials!");
        }

        return [
            'id' => (int) $data['user_id'],
            'token' => $token
        ];
    }
}