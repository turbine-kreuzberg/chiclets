<?php

namespace App\Services\GitLab;

use App\Services\GitLab\Config\ConfigInterface;
use App\Services\GitLab\Model\Pipeline;
use App\Services\GitLab\Model\PipelineCollection;
use App\Services\GitLab\Model\Project;
use App\Services\GitLab\Model\ProjectCollection;
use GuzzleHttp\Client;

class GitLabService implements GitlabServiceInterface
{
    private const GET_PIPELINES_URL_PATTERN = '/api/v4/projects/%s/pipelines';
    private const GET_PROJECTS_URL = '/api/v4/projects';

    public function __construct(private ConfigInterface $config)
    {

    }

    public function getPipelines(): PipelineCollection
    {
        $url = sprintf(self::GET_PIPELINES_URL_PATTERN, $this->config->getCurrentProjectId());
        $response = json_decode($this->getConnection()->get($url)->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $pipelineCollection = new PipelineCollection();
        foreach ($response as $pipeline) {
            $pipelineObj = new Pipeline($pipeline);

            $pipelineCollection[] = $pipelineObj;
        }

        return $pipelineCollection;
    }

    public function getProjects(): ProjectCollection
    {
        $response = json_decode($this->getConnection()->get(self::GET_PROJECTS_URL)->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $projectCollection = new ProjectCollection();
        foreach ($response as $project) {
            $projectObj = new Project($project);

            $projectCollection[] = $projectObj;
        }

        return $projectCollection;
    }

    private function getConnection(): Client {
        static $connection = null;
        if ($connection === null) {
            $connection = new Client([
                'base_uri' => $this->config->getBaseUrl(),
                'headers' => [
                    'PRIVATE-TOKEN' => $this->config->getToken(),
                ],
            ]);
        }

        return $connection;
    }
}
