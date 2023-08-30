<?php

namespace App\Livewire;

use App\Models\Config;
use App\Services\GitLab\Config\ChicletsConfig;
use App\Services\GitLab\GitLabService;
use Livewire\Component;

class Projects extends Component
{
    public $projects;

    public $currentProjectId;

    private GitLabService $gitlabService;

    public function mount(GitLabService $gitLabService, ChicletsConfig $config)
    {
        $this->projects = $gitLabService->getProjects()->serialize();
        $this->currentProjectId = $config->getCurrentProjectId();
    }

    public function render()
    {
        return view('livewire.projects');
    }

    public function setCurrentProject($projectId): void
    {
        $config = Config::first(); // Handle possible non existing config (should not happen)
        $config->current_project_id = $projectId;
        $config->save();

        $this->dispatch('projectChanged', projectId: $projectId)->to(Pipelines::class);
    }
}
