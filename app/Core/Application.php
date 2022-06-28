<?php

namespace App\Core;

use App\Core\DB;
use PDO;
use App\Core\ConfigInterface;

class Application {

    private static PDO $db;

    public function __construct(protected ConfigInterface $config)
    {
        self::$db = DB::connect($config->db[0]);
    }

    public static function db(): PDO
    {
       return self::$db;
    }
}