<?php

namespace App\Services\GitLab\Config;

use App\Models\Config;

class ChicletsConfig implements ConfigInterface
{
    private Config $config;

    public function __construct()
    {
        $this->config = Config::first();
    }

    public function getBaseUrl(): string
    {
        return $this->config->getGitlabUrl();
    }

    public function getToken(): string
    {
        return $this->config->getGitlabApiToken();
    }

    public function getCurrentProjectId(): string
    {
        return $this->config->getProjectId();
    }
}