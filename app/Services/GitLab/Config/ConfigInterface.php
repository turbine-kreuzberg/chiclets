<?php

namespace App\Services\GitLab\Config;

interface ConfigInterface
{
    public function getBaseUrl(): string;

    public function getToken(): string;

    public function getCurrentProjectId(): string;

    public function getPipelineDisplayNumber(): int;
}
