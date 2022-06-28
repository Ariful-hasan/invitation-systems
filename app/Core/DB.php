<?php

namespace App\Core;

use PDO;
use PDOException;


class DB {

    protected static $connection = false;

    private function __construct()
    {
          
    }

    public static function connect(array $config): PDO
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        if (!self::$connection) {
            try {
                self::$connection = new PDO(
                    $config['driver'].':host='.$config['host'].';dbname='.$config['dbname'],
                    $config['user'],
                    $config['password'],
                    $config['options'] ?? $defaultOptions
                );
            } catch (\PDOException $e) {
                throw new PDOException($e->getMessage(), $e->getCode());
            }  
        }
         
        return self::$connection;
    }
}