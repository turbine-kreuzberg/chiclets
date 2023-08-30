<?php

namespace App\Services\VCS;

use App\Services\VCS\GitLab\Model\PipelineCollection;
use App\Services\VCS\GitLab\Model\ProjectCollection;

interface GitServiceInterface
{
    public function getPipelines(): PipelineCollection;

    public function getProjects(): ProjectCollection;

    public function testConnection(string $url, string $token): bool;
}
