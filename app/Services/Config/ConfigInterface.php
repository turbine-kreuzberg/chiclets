<?php

namespace App\Services\Config;

interface ConfigInterface
{
    public function getBaseUrl(): string;
    public function getToken(): string;
    public function getCurrentProjectId(): ?string;
    public function getPipelineDisplayNumber(): int;
    public function getCacheTTL(): string;
}
