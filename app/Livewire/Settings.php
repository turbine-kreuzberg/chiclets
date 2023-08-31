<?php

namespace App\Livewire;

use App\Models\Config;
use App\Services\VCS\GitServiceInterface;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Settings extends Component
{
    public Config $config;

    public array $configData;

    private const PARAM_GITLAB_URL = 'gitlab_url';

    private const PARAM_GITLAB_API_TOKEN = 'gitlab_api_token';

    private readonly GitServiceInterface $gitService;

    public function boot(GitServiceInterface $gitService)
    {
        $this->gitService = $gitService;
    }

    protected array $rules = [
        'configData.gitlab_url' => 'required|url:https',
        'configData.gitlab_api_token' => 'required',
        'configData.pipeline_display_number' => 'required|integer|min:1',
    ];

    public function mount(): void
    {
        $this->config = Config::first() ?: Config::create();

        $this->configData = $this->config->toArray();
    }

    public function render(): View
    {
        return view('livewire.settings');
    }

    public function save(): ?Redirector
    {
        $this->validate();

        $validConnection = $this->gitService->testConnection($this->configData[self::PARAM_GITLAB_URL], $this->configData[self::PARAM_GITLAB_API_TOKEN]);

        if (! $validConnection) {
            session()->flash('message', 'Connection error.');
            return null;
        }

        $this->config->fill($this->configData);
        $this->config->save();

        return redirect()->to('/pipelines');
    }
}
