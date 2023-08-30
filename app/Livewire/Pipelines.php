<?php

namespace App\Livewire;

use App\Models\Config;
use App\Services\GitLab\Config\ChicletsConfig;
use App\Services\GitLab\GitLabService;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Laravel\Shell;

class Pipelines extends Component
{
    public $pipelines = [];

    private GitLabService $gitLabService;

    private ChicletsConfig $config;

    public function render()
    {
        return view('livewire.pipelines');
    }

    public function boot(GitLabService $gitLabService, ChicletsConfig $config): void
    {
        $this->gitLabService = $gitLabService;
        $this->config = $config;
        $this->pipelines = $this->gitLabService->getPipelines()->serialize() ?? [];
    }

    #[On('projectChanged')]
    public function updatePipelines($projectId)
    {
        $this->pipelines = $this->gitLabService->getPipelines()->serialize() ?? [];
    }
}
