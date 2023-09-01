<?php

namespace App\Models;

use App\Exceptions\InvalidArgumentException;

class Navigation
{
    /**
     * @var array<int, NavigationItem>
     */
    private array $items;

    public static function create(array $items): self
    {
        return new self($items);
    }

    private function __construct(array $items)
    {
        foreach ($items as $item) {
            if (! $item instanceof NavigationItem) {
                throw new InvalidArgumentException('Navigation::$items must be array of NavigationItem');
            }
        }

        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
