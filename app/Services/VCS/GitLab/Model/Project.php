<?php

namespace App\Services\VCS\GitLab\Model;

class Project
{
    private int $id;

    private ?string $name;

    private ?string $web_url;

    private ?string $avatar_url;

    private ?string $default_branch;

    public function __construct(array $data = [])
    {
        foreach ($data as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = $value;
            }
        }
    }

    public function getId(): int
    {
        return $this->id ?? 0;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function getWebUrl(): ?string
    {
        return $this->web_url ?? null;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatar_url ?? null;
    }

    public function getDefaultBranch(): ?string
    {
        return $this->default_branch ?? null;
    }
}
