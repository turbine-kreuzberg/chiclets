<?php

namespace App\Livewire;

use App\Models\Config;
use Illuminate\Contracts\View\View;
use Livewire\Component;

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
        $this->config = Config::firstOr(static function (){
            Config::create([
                'gitlab_url' => '',
                'gitlab_api_token' => '',
                'pipeline_display_number' => 5
            ]);
        });

        $this->configData = $this->config->toArray();
    }

    public function render(): View
    {
        return view('livewire.settings');
    }

    public function save(): void
    {
        $this->validate();
        $this->config->fill($this->configData);
        $this->config->save();
    }
}

