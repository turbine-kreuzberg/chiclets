<?php

namespace App\Services\GitLab\Model;

class Project
{
    private int $id;
    private string|null $name;
    private string|null $web_url;
    private string|null $avatar_url;
    private string|null $default_branch;

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
