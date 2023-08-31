<?php

/** @noinspection PhpUnused */

namespace App\Models;

class NavigationItem
{
    public static function create(string $label, string $href): self
    {
        return new self($label, $href, null);
    }

    public static function createCloseItem(string $label): self
    {
        return new self($label, '#', 'window.close(); return false');
    }

    private function __construct(
        private readonly string $label,
        private readonly string $href,
        private readonly ?string $onClick,
    ) {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getOnClick(): ?string
    {
        return $this->onClick;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function withCloseTrigger(): self
    {
        return new self($this->label, 'window.close(); return false', $this->href);
    }
}
