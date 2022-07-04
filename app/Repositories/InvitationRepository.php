<?php

namespace App\Repositories;

use App\Models\Invitation;

class InvitationRepository
{
    public function __construct(private Invitation $invitation)
    {
        # code...
    }

    /**
     * find invitation with conditions
     *
     * @param  mixed $where
     * @return array
     */
    public function find(array $where): array
    {
        $this->invitation->where = $where;

        return $this->invitation->find();
    }

    /**
     * create new invitation
     * 
     * @param  mixed $data
     * @return int invitation id
     */
    public function create(array $data): int
    {
        return $this->invitation->create($data);
    }

    /**
     * update user by user-id.
     *
     * @param  mixed $id
     * @param  mixed $fields
     * @return void
     */
    public function updateById(int $id, array $fields)
    {
        $this->invitation->where = $fields;
        return $this->invitation->updateById($id);
    }
}