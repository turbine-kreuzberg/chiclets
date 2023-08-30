<?php

namespace App\Services\Cache\Memory;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Psr\Cache\CacheItemInterface;

class MemoryCacheEntry implements CacheItemInterface
{
    public function __construct(
        readonly private string $key,
        private mixed $data,
        private DateTimeInterface $ttl,
    ) {
    }

    public function isAlive(): bool
    {
        return $this->ttl >= new DateTime('now');
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function get(): mixed
    {
        return $this->data;
    }

    public function isHit(): bool
    {
        return true;
    }

    public function set(mixed $value): static
    {
        $this->data = $value;
        return $this;
    }

    public function expiresAt(?DateTimeInterface $expiration): static
    {
        if ($expiration === null) {
            $expiration = new DateTime();
        }
        $this->ttl = $expiration;
        return $this;
    }

    public function expiresAfter(DateInterval|int|null $time): static
    {
        if ($time === null || is_numeric($time)) {
            $time = new DateInterval($time ?? 0);
        }
        $this->ttl = (new DateTime())->add($time);
        return $this;
    }
}
