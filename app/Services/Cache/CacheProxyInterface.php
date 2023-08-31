<?php

namespace App\Services\Cache;

use DateTime;

interface CacheProxyInterface
{
    public function has(string $id);

    public function retrieve(string $id): mixed;

    public function store(string $id, mixed $data, DateTime $ttl = null): mixed;

    public function delete(string $id);
}
