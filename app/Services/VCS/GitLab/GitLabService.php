<?php

namespace App\Services\VCS\GitLab;

use App\Services\Cache\CacheProxyInterface;
use App\Services\VCS\GitLab\Connection\GitConnectionInterface;
use App\Services\VCS\GitLab\Model\PipelineCollection;
use App\Services\VCS\GitLab\Model\ProjectCollection;
use App\Services\VCS\GitServiceInterface;

class GitLabService implements GitServiceInterface
{
    private const PROJECTS_CACHE_ID = 'projects';

    public function __construct(
        readonly private GitConnectionInterface $connection,
        readonly private CacheProxyInterface $cache,
    ) {
    }

    public function getProjects(): ProjectCollection
    {
        if ($this->cache->has(self::PROJECTS_CACHE_ID)) {
            return $this->cache->retrieve(self::PROJECTS_CACHE_ID);
        }

        return $this->cache->store(self::PROJECTS_CACHE_ID, $this->connection->getProjects());
    }

    public function getPipelines(): PipelineCollection
    {
        return $this->connection->getPipelines();
    }

    public function testConnection(string $url, string $token): bool
    {
        return $this->connection->testConnection($url, $token);
    }
}
