<?php

namespace App\Services\GitLab;

use App\Services\GitLab\Model\PipelineCollection;
use App\Services\GitLab\Model\ProjectCollection;

interface GitlabServiceInterface
{
    public function getPipelines() : PipelineCollection;
    public function getProjects() : ProjectCollection;
}
