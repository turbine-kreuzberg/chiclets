<?php

namespace App\Livewire;

use App\Models\Config;
use Livewire\Component;

class Settings extends Component
{
    public string $gitlab_url = '';

    public string $gitlab_api_token = 'foo';

    public int $pipeline_display_number = 5;

    public function save()
    {
        Config::firstOr(function (){
            return Config::create();
        })->update($this->only([
            'gitlab_url',
            'gitlab_api_token',
            'pipeline_display_number',
        ]));
    }


    public function render()
    {
        return view('livewire.settings');
    }
}

