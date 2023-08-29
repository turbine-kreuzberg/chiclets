<?php

namespace App\Services\GitLab\Model;

class PipelineCollection implements \ArrayAccess, \Countable
{

    public function offsetExists(mixed $offset): bool
    {
        // TODO: Implement offsetExists() method.
        return false;
    }

    public function offsetGet(mixed $offset): mixed
    {
        // TODO: Implement offsetGet() method.
        return null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset(mixed $offset): void
    {
        // TODO: Implement offsetUnset() method.
    }

    public function count(): int
    {
        // TODO: Implement count() method.
        return 0;
    }
}
