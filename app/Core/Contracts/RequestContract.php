<?php

namespace App\Core\Contracts;

interface RequestContract
{
    public function getMethod();

    public function getUrl();

    public function getBody(): array;

    public function validated(): array;

    public function getBearerToken(): string;
}