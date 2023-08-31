<?php

namespace App\Livewire;

use App\Models\Config;
use App\Services\Config\ConfigInterface;
use App\Services\VCS\GitServiceInterface;
use Livewire\Component;

class Projects extends Component
{
    public array $projects;

    public ?string $currentProjectId;

    public function mount(GitServiceInterface $gitService, ConfigInterface $config)
    {
        $this->projects = $gitService->getProjects()->serialize();
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
