<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function __construct(private User $user)
    {
        
    }

    public function find(array $where)
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
}