<?php

namespace App\Core;

use App\Core\ConfigInterface;

class Config implements ConfigInterface {

    protected array $config = [];

    public function __construct(array $_env)
    {
        $this->config = [
            'db' => [
                [
                    DBDRIVER => $_env['DB_DRIVER'],
                    DBHOST => $_env['DB_HOST'],
                    DBNAME => $_env['DB_NAME'],
                    DBUSER => $_env['DB_USER'],
                    DBPASSWORD => $_env['DB_PASSWORD'],
                ]
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }

}