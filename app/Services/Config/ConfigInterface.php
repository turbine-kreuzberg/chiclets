<?php

namespace App\Services\Config;

interface ConfigInterface
{
    public function getBaseUrl(): string;
    public function getToken(): string;
}
