<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Laravel\Facades\Window;

class FireWorkTrigger extends Component
{
    public function render()
    {
        return view('livewire.fire-work-trigger');
    }

    public function open(): void
    {
        Window::open('fire-work')
            ->showDevTools(false)
            ->transparent()
            ->fullscreen(true)
            ->route('settings');
    }

    public function close(): void
    {
        Window::close('fire-work');
    }
}
