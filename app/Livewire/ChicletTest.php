<?php

namespace App\Livewire;

use App\Services\GitLab\GitLabService;
use Livewire\Component;

class ChicletTest extends Component
{
    public $projects;

    private GitLabService $gitlabService;

    public function mount(GitLabService $gitLabService)
    {
        $this->gitlabService = $gitLabService;
    }

    public function render()
    {
        $this->projects = $this->gitlabService->getProjects()->serialize();

        //        var_dump($this->projects);

        return view('livewire.chiclet-test');
    }
}
