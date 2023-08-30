<?php

namespace App\Livewire;

use App\Models\Config;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Settings extends Component
{
    public Config $config;

    public array $configData;

    public function mount(): void
    {
        $this->config = Config::first() ?: new Config([
            'gitlab_url' => '',
            'gitlab_api_token' => '',
            'pipeline_display_number' => 5
        ]);

        $this->configData = $this->config->toArray();
    }

    public function render(): View
    {
        return view('livewire.settings');
    }

    public function save(): void
    {
        $this->config->fill($this->configData);
        $this->config->save();
    }
}

