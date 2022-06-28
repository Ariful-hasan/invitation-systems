<?php

namespace App\Core;

interface ConfigInterface {

    public function __construct (array $config);

    public function __get(string $name);
}