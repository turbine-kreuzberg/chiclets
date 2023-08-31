<?php

namespace App\Livewire;

use App\Services\VCS\GitServiceInterface;
use Livewire\Component;

class ChicletTest extends Component
{
    public $projects;

    private GitServiceInterface $gitlabService;

    public function mount(GitServiceInterface $gitLabService)
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
