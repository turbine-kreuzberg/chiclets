<?php

namespace App\Livewire;

use App\Models\Config;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Settings extends Component
{
    public Config $config;

    public array $configData;

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

    public function save(): Redirector
    {
        $this->validate();
        $this->config->fill($this->configData);
        $this->config->save();

        return redirect()->to('/pipelines');
    }
}

