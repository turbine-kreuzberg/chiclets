<?php

namespace App\Services\VCS\GitLab\Model;

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
        $this->collection = [];
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
        if (! ($value instanceof Pipeline)) {
            throw new InvalidArgumentException('Invalid pipeline instance');
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

    /**
     * @return Pipeline[]
     */
    public function toArray(): array
    {
        $list = [];
        foreach ($this->collection as $pipeline) {
            $list[] = clone $pipeline;
        }

        return $list;
    }

    public function serialize(): array
    {
        $list = [];
        foreach ($this->collection as $pipeline) {
            $list[] = [
                'id' => $pipeline->getId(),
                'projectId' => $pipeline->getProjectId(),
                'status' => $pipeline->getStatus(),
                'ref' => $pipeline->getRef(),
                'name' => $pipeline->getName(),
                'webUrl' => $pipeline->getWebUrl(),
                'createdAt' => $pipeline->getCreatedAt(),
                'updatedAt' => $pipeline->getUpdatedAt(),
            ];
        }

        return $list;
    }
}
