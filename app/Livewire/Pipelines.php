<?php

namespace App\Livewire;

use App\Services\Config\ChicletsConfig;
use App\Services\VCS\GitServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Laravel\Client\Client;
use Native\Laravel\Facades\Notification;
use Native\Laravel\Shell;

class Pipelines extends Component
{
    public array $pipelines = [];

    public bool $projectSelected;

    private GitServiceInterface $gitService;

    private Shell $shell;

    private array $pipelinesState = [];

    public function render()
    {
        return view('livewire.pipelines');
    }

    public function boot(GitServiceInterface $gitService, ChicletsConfig $config): void
    {
        $this->gitService = $gitService;

        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
        $this->projectSelected = (bool) $config->getCurrentProjectId();
        $this->shell = new Shell(new Client());

        $this->checkPipelineUpdates();
    }

    #[On('projectChanged')]
    public function updatePipelines($projectId): void
    {
        $this->pipelinesState = [];
        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
    }

    public function openPipelineUrl(string $pipelineWebUrl)
    {
        $this->shell->openExternal($pipelineWebUrl);
    }

    private function checkPipelineUpdates()
    {
        if (! $this->pipelines) {
            return;
        }

        if (! $this->pipelinesState) {
            $this->updatePipelinesStates();

            return;
        }

        if (! array_key_exists(reset($this->pipelines)['id'], $this->pipelinesState)) {
            Notification::title('Chiclets')
                ->message('New pipelines created.')
                ->show();
        }

        foreach ($this->pipelines as $pipeline) {
            $pipelineId = $pipeline['id'];
            if (! array_key_exists($pipelineId, $this->pipelinesState)) {
                continue;
            }

            if ($pipeline['status'] !== $this->pipelinesState[$pipelineId]['status']) {
                Notification::title('Chiclets')
                    ->message(sprintf('Pipeline %s status was updated to %s', $pipelineId, $pipeline['status']))
                    ->show();
            }
        }

        $this->updatePipelinesStates();
    }

    private function updatePipelinesStates(): void
    {
        foreach ($this->pipelines as $pipeline) {
            $this->pipelinesState[$pipeline['id']] = $pipeline;
        }
    }
}
