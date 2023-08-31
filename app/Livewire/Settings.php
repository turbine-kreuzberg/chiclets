<?php

namespace App\Livewire;

use App\Models\Config;
use App\Services\VCS\GitLab\GitLabService;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Settings extends Component
{
    private const PARAM_GITLAB_URL = 'gitlab_url';

    private const PARAM_GITLAB_API_TOKEN = 'gitlab_api_token';

    private const PARAM_PIPELINE_DISPLAY_NUMBER = 'pipeline_display_number';

    public Config $config;

    public array $configData;

    private readonly GitLabService $gitService;

    public function boot(GitLabService $gitService): void
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
        $this->config = Config::first() ?: Config::create([
            self::PARAM_GITLAB_URL => 'https://git.turbinekreuzberg.io',
            self::PARAM_PIPELINE_DISPLAY_NUMBER => 5,
        ]);

        $this->configData = $this->config->toArray();
    }

    public function render(): View
    {
        return view('livewire.settings');
    }

    public function save(): ?Redirector
    {
        $this->validate();

        $gitlabUrl = $this->configData[self::PARAM_GITLAB_URL];
        $gitlabToken = $this->configData[self::PARAM_GITLAB_API_TOKEN];

        $validConnection = $this->gitService->testConnection($gitlabUrl, $gitlabToken);

        if (! $validConnection) {
            session()->flash('message', 'Connection error.');

            return null;
        }

        $this->config->fill($this->configData);
        $this->config->save();

        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return redirect()->to(ROUTE_NAME_PIPELINES);
    }
}
