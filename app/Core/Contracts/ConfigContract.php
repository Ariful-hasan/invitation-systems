<?php

namespace App\Core\Contracts;

interface ConfigContract {

    public function __construct (array $config);

    public function __get(string $name);
}