<?php

namespace App\Services\VCS\GitLab\Connection;

use App\Services\Config\ConfigInterface;
use App\Services\VCS\GitLab\Model\PipelineCollection;
use App\Services\VCS\GitLab\Model\ProjectCollection;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class GitLabConnection implements GitConnectionInterface
{
    private const GET_PIPELINES_URL_PATTERN = '/api/v4/projects/%s/pipelines?order_by=updated_at&per_page=%d';

    private const GET_PROJECTS_URL_PATTERN = '/api/v4/projects?membership=true&per_page=500&order_by=updated_at&archived=false&updated_after=%s';

    private const GET_VERSION_URL_PATTERN = '/api/v4/version';

    public function __construct(
        readonly private ConfigInterface $config,
    ) {
    }

    public function getPipelines(): PipelineCollection
    {
        $currentProjectId = $this->config->getCurrentProjectId();

        if (empty($currentProjectId)) {
            return new PipelineCollection();
        }

        $url = sprintf(
            self::GET_PIPELINES_URL_PATTERN,
            $this->config->getCurrentProjectId(),
            $this->config->getPipelineDisplayNumber(),
        );

        $response = json_decode($this->getConnection()->get($url)->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return new PipelineCollection($response);
    }

    public function getProjects(): ProjectCollection
    {
        $url = sprintf(self::GET_PROJECTS_URL_PATTERN, (new \DateTime('-1 month'))->format('c'));
        $response = json_decode($this->getConnection()->get($url)->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return new ProjectCollection($response);
    }

    public function testConnection(
        string $url,
        string $token
    ): bool {
        $client = new Client([
            'base_uri' => $url.self::GET_VERSION_URL_PATTERN,
            'headers' => [
                'PRIVATE-TOKEN' => $token,
            ],
        ]);

        try {
            $response = $client->get(self::GET_VERSION_URL_PATTERN);
            $statusCode = $response->getStatusCode();
        } catch (\Throwable) {
            return false;
        }

        try {
            $responseData = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            return false;
        }

        return $statusCode === Response::HTTP_OK
            && ! empty($responseData['version'])
            && ! empty($responseData['revision']);
    }

    private function getConnection(): Client
    {
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
