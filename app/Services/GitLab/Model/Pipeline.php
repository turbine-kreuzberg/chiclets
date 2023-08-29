<?php

namespace App\Services\GitLab\Model;

class Pipeline
{
    private int $id;
    private int $project_id;
    private string $status;
    private string $ref;
    private string $name;
    private string $web_url;
    private string $created_at;
    private string $updated_at;

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

    public function getProjectId(): int
    {
        return $this->project_id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getRef(): string
    {
        return $this->ref;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWebUrl(): string
    {
        return $this->web_url;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
