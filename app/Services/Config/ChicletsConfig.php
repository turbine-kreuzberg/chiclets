<?php

namespace App\Services\Config;

use App\Models\Config;
use App\Services\Config\Exceptions\NoConfigException;

class ChicletsConfig implements ConfigInterface
{
    private ?Config $config = null;

    public function hasConfig(): bool
    {
        try {
            $config = $this->getConfig();
        } catch (NoConfigException) {
            return false;
        }

        return $config->isConfigured();
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getBaseUrl(): string
    {
        return $this->getConfig()->gitlab_url;
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getToken(): string
    {
        return $this->getConfig()->gitlab_api_token;
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getCurrentProjectId(): ?string
    {
        return $this->getConfig()->current_project_id;
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getPipelineDisplayNumber(): int
    {
        return $this->getConfig()->pipeline_display_number ?? 5;
    }

    public function getCacheTTL(): string
    {
        return '5 minutes';
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    private function getConfig(): Config
    {
        if ($this->config === null) {
            $this->config = Config::first();
            if ($this->config === null) {
                throw new NoConfigException();
            }
        }

        return $this->config;
    }
}
