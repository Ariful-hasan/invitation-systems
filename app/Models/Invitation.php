<?php

namespace App\Models;

use App\Models\Model;

class Invitation extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->table = 'invitations';
        $this->fillable = ['sender','receiver','status'];
        $this->timestamp = true;
    }
}