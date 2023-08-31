<?php

namespace App\Services\VCS\GitLab\Model;

class Pipeline
{
    private int $id;

    private ?int $project_id;

    private ?string $status;

    private ?string $ref;

    private ?string $name;

    private ?string $web_url;

    private ?string $created_at;

    private ?string $updated_at;

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

    public function getStateIcon(): string
    {
        $map = [
            'failed' => 'fa-solid fa-xmark c-error',
            'success' => 'fa-solid fa-check c-primary',
            'pending' => 'fa-solid fa-spinner fa-spin',
            'canceled' => 'fa-solid fa-ban',
            'unknown' => 'fa-solid fa-bug',
        ];

        return $map[$this->getStatus()] ?? $map['unknown'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'projectId' => $this->getProjectId(),
            'status' => $this->getStatus(),
            'statusIcon' => $this->getStateIcon(),
            'ref' => $this->getRef(),
            'name' => $this->getName(),
            'webUrl' => $this->getWebUrl(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }
}
