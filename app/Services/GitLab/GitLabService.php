<?php

namespace App\Services\GitLab;

use App\Services\Config\ConfigInterface;
use App\Services\GitLab\Model\PipelineCollection;
use App\Services\GitLab\Model\ProjectCollection;

class GitLabService implements GitlabServiceInterface
{
    public function __construct(private ConfigInterface $config)
    {

    }

    public function getPipelines(): PipelineCollection
    {
        // make request
        // prepare response
        return new PipelineCollection();
    }

    public function getProjects(): ProjectCollection
    {
        // make request
        // prepare response
        return new ProjectCollection();
    }

    private function getConnection(): ConnectionInterface {
        static $connection = null;
        if ($connection === null) {
            $connection = new Client($this->config->getBaseUrl());
        }
        return $connection;
    }
}
