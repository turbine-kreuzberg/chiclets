<?php

namespace App\Services\GitLab\Model;

use ArrayAccess;
use Countable;
use InvalidArgumentException;

class ProjectCollection implements ArrayAccess, Countable
{
    /**
     * @var Project[]
     */
    private array $collection;

    public function __construct(array $data = [])
    {
        foreach ($data as $project) {
            $this->collection[] = new Project($project);
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet(mixed $offset): ?Project
    {
        return $this->collection[$offset] ?? null;
    }

    /**
     * @throws InvalidArgumentException if the $value argument is not an instance of Pipeline
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof Project)) {
            throw new InvalidArgumentException('Invalid project instance');
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
        foreach ($this->collection as $project) {
            $list[] = clone $project;
        }

        return $list;
    }

    public function serialize(): array
    {
        $list = [];
        foreach ($this->collection as $project) {
            $list[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'webUrl' => $project->getWebUrl(),
                'avatarUrl' => $project->getAvatarUrl(),
                'defaultBranch' => $project->getDefaultBranch(),
            ];
        }

        return $list;
    }
}
