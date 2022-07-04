<?php

namespace App\Services;

use App\Services\Service;
use App\Facades\Token;
use App\Repositories\InvitationRepository;
use App\Repositories\UserRepository;
use App\Models\User;

class InvitationService extends Service
{
    private UserRepository $userRepository;

    public function __construct(private InvitationRepository $invitationRepository)
    {
        parent::__construct();
        $this->userRepository = new UserRepository(new User());
    }
    
    /**
     * send invitation request
     *
     * @param  mixed $request
     * @return void
     */
    public function create(array $request)
    {
        try {
            if (!Token::validate($request['token'])) {
                return $this->response->send(401, "Invalid Token!");
            }

            $payload = Token::decode($request['token']);

            if (($request['id'] !== $payload['user_id']) || !$this->userRepository->find(['id'=>$request['id'], 'token'=>$request['token']])) {
                return $this->response->send(401, "Invalid User Information!");
            }
            
            $invt = ['sender' => $request['id'],'receiver' => $request['receiver']];
            $revInvt = ['sender' => $request['receiver'],'receiver' => $request['id']];

            if ($this->invitationRepository->find($invt) || $this->invitationRepository->find($revInvt)) {
                return $this->response->send(400, "Request Already Sent!");
            }
            
            $request['sender'] = $request['id'];
            if (!$this->invitationRepository->create($request)) {
                return $this->response->send(400, "Failed to Send Request!");
            }

            return $this->response->send(200, "Request Successfully Send.");
        } catch (\Exception $e) {
            return $this->response->send(500, $e->getMessage());
        }
    }
    
    /**
     * cancel, reject, accept invitation
     *
     * @param  mixed $request
     * @return void
     */
    public function update(array $request)
    {
        try {
            if (!Token::validate($request['token'])) {
                return $this->response->send(401, "Invalid Token!");
            }

            $payload = Token::decode($request['token']);

            if (($request['id'] !== $payload['user_id']) || !$this->userRepository->find(['id'=>$request['id'], 'token'=>$request['token']])) {
                return $this->response->send(401, "Invalid User Information!");
            }

            $invt = ['id' => $request['invite_id'], 'sender' => $request['id']];
            $revInvt = ['id' => $request['invite_id'], 'receiver' => $request['id']];
            $update = null;
            var_dump($this->invitationRepository->find($invt));
            // var_dump($request['status'] === CANCEL_INVITE_REQUEST);
            $update = $this->invitationRepository->updateById($request['id'], ['status' => CANCEL_INVITE_REQUEST]);
            var_dump($update);
            die;
            if ($this->invitationRepository->find($invt) && $request['status'] === CANCEL_INVITE_REQUEST) {
                $update = $this->invitationRepository->updateById($request['id'], ['status' => CANCEL_INVITE_REQUEST]);
            } elseif ($this->invitationRepository->find($revInvt) && $request['status'] !== CANCEL_INVITE_REQUEST) {
                $update = $this->invitationRepository->updateById($request['id'], ['status' => getInvitationStatus($request['status'])]);
            }

            if (!$update) {
                return $this->response->send(200, "Successfull Process Your Request.");
            }

            return $this->response->send(401, "Request Failed!");
        } catch (\Exception $e) {
            return $this->response->send(500, $e->getMessage());
        }
    }
}