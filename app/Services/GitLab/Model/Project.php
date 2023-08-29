<?php

namespace App\Services\GitLab\Model;

class Project
{
    private int $id;
    private string $name;
    private string $web_url;
    private string $avatar_url;
    private string $default_branch;

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
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWebUrl(): string
    {
        return $this->web_url;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatar_url;
    }

    public function getDefaultBranch(): string
    {
        return $this->default_branch;
    }
}
