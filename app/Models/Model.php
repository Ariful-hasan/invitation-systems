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
    public array $where;
    public string $select = "*";
    public bool $timestamp = false;

    public function __construct()
    {
        $this->db = Application::db();
    }

    /**
     * create
     *
     * @return int
     */
    public function create(array $data): int
    {
        $query = "INSERT INTO ".$this->table;
        $query .= $this->getInsertPreparedFieldQuery();
        $data = $this->getFieldData($data);
        $stmt = $this->db->prepare($query);
        $stmt->execute($data);

        return (int) $this->db->lastInsertId();
    }

    /**
     * getFieldData
     *
     * @return array
     */
    public function getFieldData(array $data): array
    {
        
        $res = [];
        if (empty($this->fillable)) {
            throw new Exception("Request data not set");
        }

        foreach ($this->fillable as $idx => $val) {
                $res[] = array_key_exists($val, $data) ? $data[$val] : "";
        }

        if ($this->timestamp) {
            $res[] = date("Y:m:d H:i:s", time());
        }

        return $res;
    }
    
    /**
     * getInsertPreparedFieldQuery
     *
     * @return string
     */
    public function getInsertPreparedFieldQuery(): string
    {
        $fields = [];
        $values = [];

        if (!empty($this->fillable)) {
            foreach ($this->fillable as $request) {
                $fields[] = $request;
                $values[] = "?";
            }
        }
        
        if ($this->timestamp) {
            $fields[] = 'created_at';
            $values[] = "?";
        }

        $query = " (". implode("," ,$fields). ") ";
        $query .= " VALUES (". implode("," ,$values). ") ";
        
        return $query;
    }

    public function updateById($id): bool
    {
        $query = "";
        if (!empty($this->where)) {
            foreach ($this->where as $field => $value) {
                $query .= $field."=?, ";
                $data[] = $value;
            }
        }
        $data[] = $id;
        $query = "UPDATE ".$this->table." SET ".$query. "WHERE id=?"; 
        $stmt= $this->db->prepare($query);
        
        return $stmt->execute($data);
    }

    /**
     * find row if exist
     *
     * @return array fetch data
     */
    public function find(): array
    {
        $conditions = "";
        $data = [];

        if (!empty($this->where)) {
            foreach ($this->where as $field => $value) {
                $conditions .= $field."=? AND ";
                $data[] = $value;
            }

            $conditions = rtrim(trim($conditions), " AND ");
        }

        $query = "SELECT ".$this->select." FROM ".$this->table." WHERE ".$conditions;
        $stmt = $this->db->prepare($query);
        $stmt->execute($data);
        $res = $stmt->fetch();

        return $res ? $res : [];
    }
}