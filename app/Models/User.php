<?php

namespace App\Models;

use App\Models\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->table = 'users';
        $this->fillable = ['name','email','password'];
        $this->timestamp = true;
    }
}