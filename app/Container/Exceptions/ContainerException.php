<?php

namespace App\Container\Exceptions;

use App\Core\ConfigInterface;
use Psr\Container\ContainerInterface;

class ContainerException extends \Exception implements ConfigInterface
{
    
}