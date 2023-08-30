<?php

namespace App\Services\GitLab\Config;

use App\Models\Config;
use App\Services\GitLab\Config\Exceptions\NoConfigException;

class ChicletsConfig implements ConfigInterface
{
    private Config|null $config = null;

    public function hasConfig(): bool
    {
        try {
            $this->getConfig();
        } catch (NoConfigException) {
            return false;
        }
        return true;
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getBaseUrl(): string
    {
        return $this->getConfig()->getGitlabUrl();
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getToken(): string
    {
        return $this->getConfig()->getGitlabApiToken();
    }

    /**
     * @throws NoConfigException if no base config record was found
     */
    public function getCurrentProjectId(): string
    {
        return $this->getConfig()->getProjectId();
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
