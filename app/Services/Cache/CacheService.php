<?php

namespace App\Services\Cache;

use App\Services\Cache\Memory\MemoryCacheEntry;
use App\Services\Config\ConfigInterface;
use DateTime;
use Psr\Cache\CacheItemPoolInterface;

class CacheService implements CacheProxyInterface
{
    public function __construct(
        readonly private CacheItemPoolInterface $pool,
        readonly private ConfigInterface $config,
    ) {
    }

    public function has(string $id): bool
    {
        return $this->pool->hasItem($id);
    }

    public function retrieve(string $id): mixed
    {
        return $this->pool->getItem($id)->get();
    }

    public function store(string $id, mixed $data, DateTime $ttl = null): mixed
    {
        if ($ttl === null) {
            $ttl = new DateTime('+'.$this->config->getCacheTTL());
        }
        $this->pool->save(new MemoryCacheEntry($id, $data, $ttl));

        return $data;
    }

    public function delete(string $id): void
    {
        $this->pool->deleteItem($id);
    }
}
