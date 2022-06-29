<?php

namespace App\Facades;

use App\Facades\Facade;
use App\Auth\AuthToken;

class Token extends Facade
{
    /**
     * Get the registered name of the helper facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return new AuthToken();
    }
}