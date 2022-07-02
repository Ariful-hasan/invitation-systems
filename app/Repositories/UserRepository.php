<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function __construct(private User $user)
    {
        
    }
    
    /**
     * find user with conditions
     *
     * @param  mixed $where
     * @return array
     */
    public function find(array $where): array
    {
        $this->user->where = $where;

        return $this->user->find();
    }
    
    /**
     * create new user
     * 
     * @param  mixed $data
     * @return int user id
     */
    public function create(array $data): int
    {
        return $this->user->create($data);
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
        $this->user->where = $fields;
        return $this->user->updateById($id);
    }
}