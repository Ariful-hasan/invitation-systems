<?php

namespace App\Http\Requests;

use App\Core\Request;

class InvitationRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * validate posted data
     * @override
     * @return array
     */
    public function validated(): array
    {
        $data = $this->getBody();
        $token = $this->getBearerToken();
        // sender
        if (!isset($data['user_id']) || !filter_var($data['user_id'], FILTER_VALIDATE_INT)) {
            return $this->response->send(400, "Invalid User!");
        }

        // receiver
        if (!isset($data['receiver']) || !filter_var($data['receiver'], FILTER_VALIDATE_INT)) {
            return $this->response->send(400, "Invalid Receiver!");
        }

        // invitation type
        if (!isset($data['status']) || strlen($data['status']) != 3 || (getInvitationStatus($data['status']) !== SEND_INVITE_REQUEST) ) {
            return $this->response->send(400, "Invalid Invitation Request!");
        }

        // token
        if (strlen($token) == 0) {
            return $this->response->send(400, "Invalid Credentials!");
        }

        $data = [
            'id' => (int) $data['user_id'],
            'receiver' => (int) $data['receiver'],
            'status' => (string) SEND_INVITE_REQUEST,
            'token' => $token
        ];

        return $data;
    }
}