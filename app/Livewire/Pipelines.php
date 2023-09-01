<?php

namespace App\Livewire;

use App\Models\PipelineState;
use App\Services\Config\ChicletsConfig;
use App\Services\VCS\GitServiceInterface;
use App\Window\FireworkWindow;
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

    private ChicletsConfig $config;

    private FireworkWindow $fireworkWindow;

    public function render()
    {
        return view('livewire.pipelines');
    }

    public function boot(GitServiceInterface $gitService, ChicletsConfig $config, FireworkWindow $fireworkWindow): void
    {
        $this->gitService = $gitService;
        $this->fireworkWindow = $fireworkWindow;
        $this->config = $config;

        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
        $this->projectSelected = (bool) $config->getCurrentProjectId();
        $this->shell = new Shell(new Client());

        $this->checkPipelineUpdates();
    }

    #[On('projectChanged')]
    public function updatePipelines($projectId): void
    {
        $this->resetPipelinesState($projectId ?: null);
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
        $pipelineState = $this->getPipelineState();
        $currentState = json_decode($pipelineState->current_state ?? '{}', true, 512, JSON_THROW_ON_ERROR);

        if (! $currentState || ($this->config->getCurrentProjectId() !== (string) $pipelineState->project_id)) {
            $this->updatePipelinesStates();

            return;
        }

        if (! array_key_exists(reset($this->pipelines)['id'], $currentState)) {
            Notification::title('Chiclets')
                ->message('New pipelines created.')
                ->show();
        }

        foreach ($this->pipelines as $pipeline) {
            $pipelineId = $pipeline['id'];
            if (! array_key_exists($pipelineId, $currentState)) {
                continue;
            }

            if ($pipeline['status'] !== $currentState[$pipelineId]['status']) {

                if ($pipeline['status'] === 'success') {
                    $this->fireworkWindow->open();
                }

                Notification::title('Chiclets')
                    ->message(sprintf('Pipeline %s status was updated to %s', $pipelineId, $pipeline['status']))
                    ->show();
            }
        }

        $this->updatePipelinesStates();
    }

    private function updatePipelinesStates(): void
    {
        $currentState = [];
        foreach ($this->pipelines as $pipeline) {
            $currentState[$pipeline['id']] = $pipeline;
        }

        $pipelineStateObj = $this->getPipelineState();
        $pipelineStateObj->current_state = json_encode($currentState, JSON_THROW_ON_ERROR);
        $pipelineStateObj->save();
    }

    private function resetPipelinesState(?int $projectId): void
    {
        $state = $this->getPipelineState();

        $state->current_state = json_encode([], JSON_THROW_ON_ERROR);
        $state->project_id = $projectId;
        $state->save();
    }

    private function getPipelineState(): PipelineState
    {
        $state = PipelineState::first() ?: PipelineState::create();

        return $state;
    }
}
