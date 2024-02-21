<?php

namespace App\Services\Cache\Memory;

use App\Services\Cache\Exceptions\CacheCollisionException;
use App\Services\Cache\Exceptions\CacheMissException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class MemoryCache implements CacheItemPoolInterface
{
    /** @var MemoryCacheEntry[] */
    private array $memory = [];

    /**
     * @throws CacheMissException if the key was not found
     */
    public function getItem(string $key): CacheItemInterface
    {
        if (! isset($this->memory[$key]) || ! $this->memory[$key]->isAlive()) {
            throw new CacheMissException();
        }

        return $this->memory[$key];
    }

    /**
     * @throws CacheMissException
     */
    public function getItems(array $keys = []): iterable
    {
        $list = [];
        foreach ($keys as $key) {
            $list[] = $this->getItem($key);
        }

        return $list;
    }

    public function hasItem(string $key): bool
    {
        try {
            $this->getItem($key);
        } catch (CacheMissException) {
            return false;
        }

        return true;
    }

    public function clear(): bool
    {
        $this->memory = [];

        return true;
    }

    public function deleteItem(string $key): bool
    {
        if (! isset($this->memory[$key])) {
            return false;
        }
        unset($this->memory[$key]);

        return true;
    }

    public function deleteItems(array $keys): bool
    {
        $result = true;
        foreach ($keys as $key) {
            $result = $result && $this->deleteItem($key);
        }

        return $result;
    }

    /**
     * @throws CacheCollisionException
     *                                 if an item is already stored with the given collision
     */
    public function save(CacheItemInterface $item): bool
    {
        $key = $item->getKey();
        if ($this->hasItem($key)) {
            throw new CacheCollisionException();
        }
        $this->memory[$key] = $item;

        return true;
    }

    /**
     * @throws CacheCollisionException
     */
    public function saveDeferred(CacheItemInterface $item): bool
    {
        return $this->save($item);
    }

    public function commit(): bool
    {
        return true;
    }
}
