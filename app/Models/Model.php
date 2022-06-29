<?php

namespace App\Models;

use Exception;
use PDO;
use App\Core\Application;

class Model 
{
    protected PDO $db;

    protected string $table;

    protected array $fillable;
    
    protected array $where;

    protected string $select = "*";

    public function __construct()
    {
        $this->db = Application::db();
    }

    /**
     * create
     *
     * @return int
     */
    // public function create(): int
    // {
    //     $query = "INSERT INTO ".$this->table;
    //     $query .= $this->getInsertPreparedFieldQuery();

    //     $data = $this->getFieldData();

    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute($data);

    //     return (int) $this->db->lastInsertId();
    // }

    // /**
    //  * find
    //  *
    //  * @return void
    //  */
    // public function find()
    // {
    //     $conditions = "";
    //     $data = [];
    //     if (!empty($this->where)) {
    //         foreach ($this->where as $field => $value) {
    //             $conditions .= $field."=? AND ";
    //             $data[] = $this->value;
    //         }
    //         $conditions = rtrim($conditions, "AND");
    //     }

    //     $query = "SELECT ".$this->select." FROM ".$this->table." WHERE ".$conditions;

    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute($data);

    //     $res = $stmt->fetch();

    //     return $res ?? [];
    // }

    // /**
    //  * getFieldData
    //  *
    //  * @return array
    //  */
    // public function getFieldData(): array
    // {
        
    //     $data = [];
    //     if (empty($this->fillable)) {
    //         throw new Exception("Request data not set");
    //     }

    //     foreach ($this->fillable as $request) {
    //             $data[] = $request['value'];
    //     }

    //     return $data;
    // }
    
    // /**
    //  * getInsertPreparedFieldQuery
    //  *
    //  * @return string
    //  */
    // public function getInsertPreparedFieldQuery(): string
    // {
    //     $fields = [];
    //     $values = [];

    //     if (!empty($this->fillable)) {
    //         foreach ($this->fillable as $request) {
    //             $fields[] = $request['name'];
    //             $values[] = "?";
    //         }
    //     }
        
    //     $query = " (". implode("," ,$fields). ") ";
    //     $query .= " VALUES (". implode("," ,$values). ") ";
        
    //     return $query;
    // }
}