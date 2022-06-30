<?php

namespace App\Contracts;

interface ConfigContract {

    public function __construct (array $config);

    public function __get(string $name);
}