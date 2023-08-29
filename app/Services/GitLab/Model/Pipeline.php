<?php

namespace App\Services\GitLab\Model;

class Pipeline
{
    private int $id;
    private int|null $project_id;
    private string|null $status;
    private string|null $ref;
    private string|null $name;
    private string|null $web_url;
    private string|null $created_at;
    private string|null $updated_at;

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

    public function getProjectId(): ?int
    {
        return $this->project_id ?? null;
    }

    public function getStatus(): ?string
    {
        return $this->status ?? null;
    }

    public function getRef(): ?string
    {
        return $this->ref ?? null;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function getWebUrl(): ?string
    {
        return $this->web_url ?? null;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at ?? null;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at ?? null;
    }
}
