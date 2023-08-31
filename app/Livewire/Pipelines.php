<?php

namespace App\Livewire;

use App\Services\VCS\GitServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Laravel\Client\Client;
use Native\Laravel\Shell;

class Pipelines extends Component
{
    public array $pipelines = [];

    private GitServiceInterface $gitService;

    private Shell $shell;

    public function render()
    {
        return view('livewire.pipelines');
    }

    public function boot(GitServiceInterface $gitService): void
    {
        $this->gitService = $gitService;
        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
        $this->shell = new Shell(new Client());
    }

    #[On('projectChanged')]
    public function updatePipelines($projectId): void
    {
        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
    }

    public function openPipelineUrl(string $pipelineWebUrl)
    {
        $this->shell->openExternal($pipelineWebUrl);
    }
}
