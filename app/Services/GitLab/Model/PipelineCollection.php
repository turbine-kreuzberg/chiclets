<?php

namespace App\Services\GitLab\Model;

use ArrayAccess;
use Countable;
use InvalidArgumentException;

class PipelineCollection implements ArrayAccess, Countable
{
    /**
     * @var Pipeline[]
     */
    private array $collection;

    public function __construct(array $data = [])
    {
        foreach ($data as $pipeline) {
            $this->collection[] = new Pipeline($pipeline);
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet(mixed $offset): ?Pipeline
    {
        return $this->collection[$offset] ?? null;
    }

    /**
     * @throws InvalidArgumentException if the $value argument is not an instance of Pipeline
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!($value instanceof Pipeline)) {
            throw new InvalidArgumentException("Invalid pipeline instance");
        }

        $this->collection[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->collection[$offset]);
    }

    public function count(): int
    {
        return count($this->collection);
    }
}
