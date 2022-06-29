<?php

namespace App\Models;

use App\Models\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->table = 'users';
    }

    public function create(array $args): int
    {
        $query = "INSERT INTO ".$this->table;
        $query .= "(name, email, password, token, created_at) ";
        $query .= "VALUES (?,?,?,?,?)";
        $stmt= $this->db->prepare($query);
        $stmt->execute([$args['name'], $args['email'], $args['password'], $args['token'], time()]);

        return (int) $this->db->lastInsertId();
    }
}