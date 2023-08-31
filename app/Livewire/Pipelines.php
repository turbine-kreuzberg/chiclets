<?php

namespace App\Livewire;

use App\Services\VCS\GitServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;

class Pipelines extends Component
{
    public array $pipelines = [];

    private GitServiceInterface $gitService;

    public function render()
    {
        return view('livewire.pipelines');
    }

    public function boot(GitServiceInterface $gitService): void
    {
        $this->gitService = $gitService;
        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
    }

    #[On('projectChanged')]
    public function updatePipelines($projectId): void
    {
        $this->pipelines = $this->gitService->getPipelines()->serialize() ?? [];
    }
}
